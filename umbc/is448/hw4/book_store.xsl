<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fn="http://www.w3.org/2005/xpath-functions"
    >
    <xsl:output method="html" indent="yes"
        doctype-system='http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'
        doctype-public='-//W3C//DTD XHTML 1.1//EN'
        />
    <xsl:template match="book_store">
        <html>
            <head>
                <title><xsl:value-of select="channel/title" /></title>
                <link rel="stylesheet" href="https://lin.noblejury.com/umbc/is448/hw4/book_store.css"/>
            </head>
            <body>
                <div class="header">
                    <div class="container left">Bookstore</div>
                </div>
                <div class="main">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author(s)</th>
                                <th>Pages</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:apply-templates select="book" />
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="book">
        <tr>
            <td>
            <xsl:element name="a">
                <xsl:attribute name="href">
                    #<xsl:value-of select="@id" disable-output-escaping="yes" />
                </xsl:attribute>
                <xsl:value-of select="@title" />
            </xsl:element>
        </td>
        <td>
            <xsl:apply-templates select="author" />
        </td>
        <td>
                <xsl:value-of select="@pages" />
        </td>
        <td>
                $<xsl:value-of select="@price" />
        </td>
        </tr>
    </xsl:template>
    <xsl:template match="author">
        <p>
            <xsl:value-of select="@last" /><xsl:text>,&#160;</xsl:text><xsl:value-of select="@first" />
        </p>
    </xsl:template>
</xsl:stylesheet>
