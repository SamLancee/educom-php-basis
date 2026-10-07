<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <!-- Bij cinema voer deze layout uit: -->
    <xsl:template match="/cinema">
        <div>
            <!-- @ is altijd voor een attribuut -->
            <h2>Filmagenda: <xsl:value-of select="@name"/> (<xsl:value-of select="@city"/>)</h2>
            
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Genre</th>
                    <th>Regisseur</th>
                    <th>Duur</th>
                    <th>Beoordeling</th>
                    <th>Leeftijd</th>
                    <th>Zaal</th>
                </tr>

                <!-- Loop voor movie binnen cinema -->
                <xsl:for-each select="movie">
                    <!-- Sorteren op rating MOET direct als eerste tag in for-each staan -->
                    <xsl:sort select="rating" data-type="number" order="descending"/>
                    
                    <tr>
                        <td>
                            <strong><xsl:value-of select="title"/></strong>
                            
                        </td>
                        <td><xsl:value-of select="@genre"/></td>
                        <td><xsl:value-of select="director"/></td>
                        <td><xsl:value-of select="duration"/> min</td>
                        
                        <td>
                            <xsl:value-of select="rating"/>
                            <xsl:choose> 
                                <!--&gt staat voor greater than-->
                                <xsl:when test="rating &gt;= 8.8"> (Uitstekend)</xsl:when>
                                <xsl:when test="rating &gt;= 8.5"> (Zeer goed)</xsl:when>
                                <xsl:otherwise> (Goed)</xsl:otherwise>
                            </xsl:choose>
                        </td>

                        <td>
                            <span>
                                <xsl:attribute name="title">
                                    Minimale adviesleeftijd: <xsl:value-of select="@min_age"/> jaar
                                </xsl:attribute>
                                <xsl:value-of select="@min_age"/>+
                            </span>
                        </td>
                        
                        <td>Zaal <xsl:value-of select="hall"/></td>
                    </tr>
                </xsl:for-each>
            </table>
        </div>
    </xsl:template>

</xsl:stylesheet>