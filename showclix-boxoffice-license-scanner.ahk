???#NoEnv  ; Recommended for performance and compatibility with future AutoHotkey releases.
; #Warn  ; Enable warnings to assist with detecting common errors.
SendMode Input  ; Recommended for new scripts due to its superior speed and reliability.
SetWorkingDir %A_ScriptDir%  ; Ensures a consistent starting directory.
#KeyHistory 500
#SingleInstance force
StringCaseSense Off
SetKeyDelay, 0
MsgBox,, Otakorp License Parser,Otakorp License Parser Revision 8.5.2 Virginia Mode`nCtrl-F1 for help`nSend flames to Nova <otakon@noblejury.com>
Hotstring("EndChars", " ")
LicenseCodeExpiry:="Quick"
FullNameEntry:=0

WinWaitActive, WinTitle-to-Excel-File
WinSet, AlwaysOnTop

^F1::
MsgBox,, Otakorp License Parser, ^F1: Help`n^1: Name Only`n^2/^Q: Fulfillment Questionaire`n^3: Billing`n^P: Toggle FullNamePrefix`n^+Q: Toggle Slow-Mo`n^+K: Debugging KeyHistory
^j::
return
^+j::
return
^+k::
KeyHistory
return
^+q::
if LicenseCodeExpiry = Quick 
{
   SetKeyDelay, 100
   LicenseCodeExpiry:="Slow"
}
else
{
   SetKeyDelay, 0
   LicenseCodeExpiry:="Quick"
}
MsgBox,Expiry Mode %LicenseCodeExpiry%
return
^p::
if FullNameEntry
{
   FullNameEntry:=0
}
else
{
   FullNameEntry:=1
}
MsgBox,FullNamePrefix %FullNameEntry%
return
^q::
SplashTextOn,,,Scan License (F)
Input RS,,@
if LicenseCodeExpiry = Quick
   Input LicenseCode, T3 M, {Esc}
else
   Input LicenseCode, T10 M, {Esc}
SplashTextOff
; Send {Backspace}{Backspace}{Backspace}{Backspace}{Backspace}{Backspace}
; MsgBox, %LicenseCode%
ParseLicenseCode(LicenseCode, "Fulfillment")
LicenseCode:=""
return

^1::
SplashTextOn,,,Scan License (N.O.)
Input RS,,@
if LicenseCodeExpiry = Quick
   Input LicenseCode, T3 M, {Esc}
else
   Input LicenseCode, T10 M, {Esc}
SplashTextOff
; Send {Backspace}{Backspace}{Backspace}{Backspace}{Backspace}{Backspace}
; MsgBox, %LicenseCode%
ParseLicenseCode(LicenseCode, "NameOnly")
LicenseCode:=""
return

^2::
SplashTextOn,,,Scan License (F)
Input RS,,@
if LicenseCodeExpiry = Quick
   Input LicenseCode, T3 M, {Esc}
else
   Input LicenseCode, T10 M, {Esc}
SplashTextOff
; Send {Backspace}{Backspace}{Backspace}{Backspace}{Backspace}{Backspace}
; MsgBox, %LicenseCode%
ParseLicenseCode(LicenseCode, "Fulfillment")
LicenseCode:=""
return


^3::
SplashTextOn,,,Scan License (B)
Input RS,,@
if LicenseCodeExpiry = Quick
   Input LicenseCode, T3 M, {Esc}
else
   Input LicenseCode, T10 M, {Esc}
SplashTextOff
; Send {Backspace}{Backspace}{Backspace}{Backspace}{Backspace}{Backspace}
; MsgBox, %LicenseCode%
ParseLicenseCode(LicenseCode, "Billing")
LicenseCode:=""
return

ParseLicenseCode(LicenseCode, FieldMode)
{
BlockInput On
FullName:=""
AddressLineOne:=""
AddressLineTwo:=""
AddressCity:=""
AddressPostalCode:=""
Gender:=""
DateOfBirth:=""
DataElements:=""
DataElements:=StrSplit(LicenseCode, "`n")
Loop % DataElements.MaxIndex()
{
ParseCode:=SubStr(DataElements[A_Index],1,3)
ParseField:=SubStr(DataElements[A_Index],4)
if (ParseCode = "DCS")
   ThirdName:=ParseField
else if (ParseCode = "DAD" and ParseField != "None")
   SecondName:=" " . ParseField
else if (ParseCode = "DAA")
   FullName:=ParseField
else if (ParseCode = "DCT")
{
   NameParts:=StrSplit(ParseField, ",")
   FirstName:=NameParts[1]
   SecondName:=" " . NameParts[2]
}
else if (ParseCode = "DAC")
   FirstName:=ParseField
else if (ParseCode = "DBC" and ParseField = 1)
   Gender:="M"
else if (ParseCode = "DBC" and ParseField = 2)
   Gender:="F"
else if (ParseCode = "DAG")
   AddressLineOne:=ParseField
else if (ParseCode = "DAI")
   AddressCity:=ParseField
else if (ParseCode = "DAJ")
   AddressState:=ParseField
else if (ParseCode = "DAK" and SubStr(ParseField,4,4) = "0000")
   AddressPostalCode:=ParseField
else if (ParseCode = "DAK" and SubStr(ParseField,4,4) != "0000")
   AddressPostalCode:=SubStr(ParseField,1,5)
else if (ParseCode = "DBB" and SubStr(ParseField,5,4) > 1900)
   DateOfBirth:=SubStr(ParseField,1,2) . "/" . SubStr(ParseField,3,2) . "/" . SubStr(ParseField,5,4)
else if (ParseCode = "DBB" and SubStr(ParseField,5,4) < 1900)
   DateOfBirth:=SubStr(ParseField,5,2) . "/" . SubStr(ParseField,7,2) . "/" . SubStr(ParseField,1,4)
}
if !FullName
   FullName:=Trim(FirstName) . RTrim(SecondName) . " " . Trim(ThirdName)
if LicenseCodeExpiry = Slow
   Sleep, 100
else
   Sleep, 10
WinGetActiveTitle, CurrentWindowTitle
;if CurrentWindowTitle not contains "Select Tickets" and SecondName!=""
;   SendInput %FirstName% %ThirdName%
;else if CurrentWindowTitle not contains "Select Tickets"
;   SendInput %FullName%
;else
;{
if (FieldMode = "Fulfillment" and FullNameEntry = 1)
   SendInput %FullName%
if (FieldMode = "Fulfillment")
{
   SendInput {Tab}{Tab}United States
   SendInput {Tab}%FullName%
   SendInput {Tab}%AddressLineOne%
   SendInput {Tab}%AddressLineTwo%
   SendInput {Tab}%AddressCity%
   SendInput {Tab}%AddressState%
   SendInput {Tab}%AddressPostalCode%
   SendEvent {Tab}{Tab}{Tab}
   Sleep, 100
   SendInput %Gender%
   SendInput {Tab}%DateOfBirth%
}
else if (FieldMode = "Billing")
{
   SendInput %FirstName%
   SendInput {Tab}%ThirdName%
   SendInput {LCtrl down}f{LCtrl down}Country{Esc}{Tab}
   SendInput {Tab}{Tab}United States
   SendInput {Tab}%AddressLineOne%
   SendInput {Tab}%AddressLineTwo%
   SendInput {Tab}%AddressCity%
   SendInput {Tab}%AddressState%
   SendInput {Tab}%AddressPostalCode%
}
else
{
   SendInput %FullName%
}
;}
BlockInput Off
}