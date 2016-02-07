<?php
global $KcSeoWPSchema;
$settings = get_option($KcSeoWPSchema->options['settings']);
$schemaModel = new KcSeoSchemaModel;
?>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
    <h2><?php _e('WP SEO Structured Data Schema', KCSEO_WP_SCHEMA_SLUG);?></h2>
    <form id="kcseo-settings" onsubmit="wpSchemaSettings(this); return false;">

        <h3><?php _e('General settings for WP SEO Structured Data Schema by <a href="http://kcseopro.com/">KCSEOPro.com</a>',KCSEO_WP_SCHEMA_SLUG);?></h3>
        <div class="setting-holder">
            <table width="40%" cellpadding="10" class="form-table">
                <tr class="default">
                    <th>Enable Site link Search Box</th>
                    <td scope="row">
                        <div class="with-tooltip">
                            <input type="checkbox" name="homeonly" id="homeonly" <?php echo (@$settings['homeonly'] ? "checked" : null); ?> value="1" />

                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p><b>Tip:</b> For more detailed information on how to configure this plugin, please visit:
                                        <a href="http://kcseopro.com/wordpress-seo-structured-data-schema-plugin/">http://kcseopro.com/wordpress-seo-structured-data-schema-plugin/</a></p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="default field_homepage">
                    <th>Website Url</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="web_url" value="<?php echo (@$settings['web_url'] ? @$settings['web_url'] : null); ?>" />
                    </td>
                </tr>
                <tr class="default">
                    <th>Type</th>
                    <td align="left" scope="row">
                        <select id="site_type" name="site_type" class="select2">
                            <option value="">Select one type</option>
                            <?php
                            foreach($schemaModel->site_type() as $site){
                                $slt = ($site == @$settings['site_type'] ? "selected" : null);
                                echo "<option value='$site' $slt>$site</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr class="default">
                    <th>Organization or Business name</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="type_name" value="<?php echo (@$settings['type_name'] ? @$settings['type_name'] : null); ?>" />
                    </td>
                </tr>
                <tr class="default">
                    <th>Additional Type</th>
                    <td align="left" scope="row">
                        <div class="with-tooltip">
                            <textarea name="additionalType" placeholder="http://example1.com&#10;http://example2.com&#10;http://example3.com" rows="6" cols="50" class="additional-type"><?php echo (@$settings['additionalType'] ? esc_attr(@$settings['additionalType']) : null); ?></textarea>
                            <p class="description">Add "Additional Type" URL(s) by separate ideas</p>
                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p><b>Tip:</b> Product Ontology is an extension to schema using WikiPedia definitions that enables you to further define a type by adding an “AdditionalType” attribute.Example for a Tailor (which is not available as a schema “Type”): Pick LocalBusiness as a generic Type, then add additional type as follows:
                                        <a href="https://en.wikipedia.org/wiki/Tailor">https://en.wikipedia.org/wiki/<span>Tailor</span></a>
                                        Change to this format and enter in Additional Type field:
                                        <a href="http://www.productontology.org/id/Tailor">http://www.productontology.org/id/<span>Tailor</span></a>
                                        For more info visit:<a href="http://kcseopro.com/product-ontology-schema/">http://kcseopro.com/product-ontology-schema/</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="default business-info">
                    <th style="font-size: 18px; padding: 30px 0 5px;">Others local business info</th>
                </tr>
                <tr class="default business-info">
                    <th>Description</th>
                    <td align="left" scope="row">
                        <textarea cols="50" rows="6" name="business_info[description]"><?php echo (@$settings['business_info']['description'] ? @$settings['business_info']['description'] : null); ?></textarea>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th>Operation Hours</th>
                    <td align="left" scope="row">
                        <div class="with-tooltip">
                            <textarea name="business_info[openingHours]" placeholder="Mo-Sa 11:00-14:30&#10;Mo-Th 17:00-21:30&#10;Fr-Sa 17:00-22:00" rows="4" cols="50" class="additional-type"><?php echo (@$settings['business_info']['openingHours'] ? esc_attr(@$settings['business_info']['openingHours']) : null); ?></textarea>
                            <p class="description">- Days are specified using the following two-letter combinations: Mo, Tu, We, Th, Fr, Sa, Su.</br>
                                - Times are specified using 24:00 time. For example, 3pm is specified as 15:00. <br>
                                - Add Opening Hours by separate line</p>
                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p>
                                        <b>Tip:</b> Once you save these structured data schema settings, validate your home page url here:
                                        <a href="https://developers.google.com/structured-data/testing-tool/">https://developers.google.com/structured-data/testing-tool/</a>
                                    </p>
                                </div>
                            </div>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="font-size: 16px;">GeoCoordinates</th>
                </tr>
                <tr class="default business-info">
                    <th style="text-align: right">Longitude</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="business_info[longitude]" value="<?php echo (@$settings['business_info']['longitude'] ? @$settings['business_info']['longitude'] : null); ?>" />
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="text-align: right">Latitude</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="business_info[latitude]" value="<?php echo (@$settings['business_info']['latitude'] ? @$settings['business_info']['latitude'] : null); ?>" />
                    </td>
                </tr>


                <tr class="default person">
                    <th style="font-size: 18px; padding: 30px 0 5px;">Person</th>
                </tr>
                <tr class="default person">
                    <th>Name</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[name]" value="<?php echo (@$settings['person']['name'] ? @$settings['person']['name'] : null); ?>" />
                    </td>
                </tr>
                <tr class="default person">
                    <th>Work For</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[worksFor]"
                               value="<?php echo (@$settings['person']['worksFor'] ? @$settings['person']['worksFor'] : null); ?>" />

                    </td>
                </tr>
                <tr class="default person">
                    <th>Job Title</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[jobTitle]"
                               value="<?php echo (@$settings['person']['jobTitle'] ? @$settings['person']['jobTitle'] : null); ?>" />

                    </td>
                </tr>
                <tr class="default person">
                    <th>Image</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[image]"
                               value="<?php echo (@$settings['person']['image'] ? @$settings['person']['image'] : null); ?>" />
                        <p class="description">Add your personal photo here</p>
                    </td>
                </tr>
                <tr class="default person">
                    <th>Description</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[description]"
                               value="<?php echo (@$settings['person']['description'] ? @$settings['person']['description'] : null); ?>" />
                    </td>
                </tr>
                <tr class="default person">
                    <th>Birth date</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text kcseo-date" name="person[birthDate]"
                               value="<?php echo (@$settings['person']['birthDate'] ? @$settings['person']['birthDate'] : null); ?>" />

                    </td>
                </tr>
                <tr class="default">
                    <th style="font-size: 18px; padding: 30px 0 5px;">Address</th>
                </tr>
                <tr class="default">
                    <th>Address Country</th>
                    <td align="left" scope="row">
                        <select class="select2" name="address[country]">
                            <option value="">Select a country</option>
                            <?php
                            foreach($schemaModel->countryList() as $country){
                                $slt = ($country == @$settings['address']['country'] ? "selected" : null);
                                echo "<option value='$country' $slt>$country</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr class="default">
                    <th>Address Locality</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="address[locality]" value="<?php echo (@$settings['address']['locality'] ? @$settings['address']['locality'] : null); ?>" />
                        <p class="description">City (i.e Kansas city)</p>
                </tr>
                <tr class="default">
                    <th>Address Region</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="address[region]" value="<?php echo (@$settings['address']['region'] ? @$settings['address']['region'] : null); ?>" />
                        <p class="description">State (i.e. MO)</p>
                </tr>
                <tr class="default">
                    <th>Postal Code</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="address[postalcode]" value="<?php echo (@$settings['address']['postalcode'] ? @$settings['address']['postalcode'] : null); ?>" />
                </tr>
                <tr class="default">
                    <th>Street Address</th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="address[street]" value="<?php echo (@$settings['address']['street'] ? @$settings['address']['street'] : null); ?>" />
                </tr>
            </table>
        </div>
        <div id="tabs-container">
            <ul class="tabs-menu">
                <li class="current"><a href="#tab-1">Organization Logo</a></li>
                <li><a href="#tab-2">Social Profile</a></li>
                <li><a href="#tab-3">Corporate Contacts</a></li>
            </ul>
            <div id="tab-1" class="tab-content">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_logo">
                        <th>Logo URL </th>
                        <td scope="row">
                            <input type="text" class="regular-text" name="logo_url" value="<?php echo (@$settings['logo_url'] ? @$settings['logo_url'] : null); ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tab-2" class="tab-content">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_social">
                        <th>Company Name </th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="social_company_name" value="<?php echo (@$settings['social_company_name'] ? @$settings['social_company_name'] : null); ?>" />
                        </td>
                    </tr>
                    <tr class="field_social_title">
                        <th style="font-size: 18px; padding: 10px 0;">Social Profiles</th>
                    </tr>
                    <tr class="social_field_link">
                        <th>Social Profile</th>
                        <th>
                            <div id="social-field-holder">
                                <?php
                                $socialP = (isset($settings['social']) ? ($settings['social'] ? $settings['social'] : array()) : array() );
                                if(is_array($socialP) && !empty($socialP)) {
                                    $html = null;
                                    $i = 0;
                                    foreach ($socialP as $socialD) {
                                        $html .= "<div class='sfield'>";
                                        $html .= "<select name='social[$i][id]'>";
                                        foreach ($schemaModel->socialList() as $sId => $social) {
                                            $slt = ($sId == $socialD['id'] ? "selected" : null);
                                            $html .= "<option value='$sId' $slt>$social</option>";
                                        }
                                        $html .= "</select>";
                                        $html .= "<input type='text' name='social[$i][link]' value='{$socialD['link']}'>";
                                        $html .= '<span class="dashicons dashicons-trash social-remove"></span>';
                                        $html .= "</div>";
                                        $i++;
                                    }
                                    echo $html;
                                }
                                ?>
                            </div>
                            <a class="button button-primary add-new" id="social-add" >Add Social Profile</a>
                        </th>
                    </tr>
                </table>
            </div>
            <div id="tab-3" class="tab-content">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_contact">
                        <th style="font-size: 18px; padding: 10px 0;">Contacts</th>
                    </tr>
                    <tr class="field_contact">
                        <th>Contact Type </th>
                        <td scope="row">
                            <select name="contact[contactType]" class="select2">
                                <?php
                                foreach($schemaModel->contactType() as $ctype){
                                    $slt = ($ctype == $settings['contact']['contactType'] ? "selected" : null);
                                    echo "<option value='$ctype' $slt>$ctype</option>";
                                }

                                ?>
                            </select>
                        </td>

                    </tr>
                    <tr class="field_contact">
                        <th>Contact Phone </th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="contact[telephone]" value="<?php echo (@$settings['contact']['telephone'] ? @$settings['contact']['telephone'] : null); ?>" />
                            <p class="description kco-telephone">Please follow the format below<span style="font-size: 11px;">+1-505-998-3793</span><span style="font-size: 11px;">(425) 123-4567</span><span style="font-size: 11px;">( 33 1) 42 68 53 01</span><span style="font-size: 11px;">+44-2078225951</span><span style="font-size: 11px;">1 (855) 469-6378</span>
                            </p>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th>Contact Option </th>
                        <td align="left" scope="row">
                            <select name="contact[contactOption]" class="select2">
                                <option value="TollFree" <?php echo ($settings['contact']['contactOption'] == "TollFree" ? "selected" : null); ?>>TollFree</option>
                                <option value="HearingImpairedSupported" <?php echo ($settings['contact']['contactOption'] == "HearingImpairedSupported" ? "selected" : null); ?>>HearingImpairedSupported</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th>Area Served</th>
                        <td align="left" scope="row">
                            <div class="area_served_wrapper">
                                <select id="area_served" class="select2" name="area_served[]" multiple="multiple" style="width: 50%">
                                    <?php
                                    foreach($schemaModel->countryList() as $country){
                                        $slt = (in_array($country, $settings['area_served']) ? "selected" : null);
                                        echo "<option value='$country' $slt>$country</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th>Available language </th>
                        <td scope="row" class="lang">
                            <select class="select2" name="availableLanguage" style="width: 50%">
                                <?php
                                foreach($schemaModel->languageList() as $language){
                                    $slt = ($language == $settings['availableLanguage'] ? "selected" : null);
                                    echo "<option value='$language' $slt>$language</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <h2>Site Name in Search Results</h2>
        <table width="100%" cellpadding="10" class="form-table">
            <tr class="default">
                <th>Site Name: </th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="sitename" value="<?php echo (@$settings['sitename'] ? @$settings['sitename'] : null); ?>" />
                </td>
            </tr>
            <tr class="default">
                <th>Site Alternative Name: </th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="siteaname" value="<?php echo (@$settings['siteaname'] ? @$settings['siteaname'] : null); ?>" />
                </td>
            </tr>
            <tr class="default">
                <th>Site Url: </th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="siteurl" value="<?php echo (@$settings['siteurl'] ? @$settings['siteurl'] : get_home_url()); ?>" />
                </td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary" value="<?php _e('Save Changes', KCSEO_WP_SCHEMA_SLUG); ?>"></p>

        <?php wp_nonce_field( $KcSeoWPSchema->nonceText(), '_kcseo_nonce' ); ?>
    </form>
    <div id="response"></div>
</div>
