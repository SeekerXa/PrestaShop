{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div class="block-contact col-md-3 links wrapper">
    <div class="hidden-sm-down">
        <p class="h4 text-uppercase block-contact-title" id="store_name_footer">{$contact_infos.company}</p>
        <div id="panel_footer">
            <span id="store_info_footer">
                <div id="double_column">
                    <span class="icon-location-pin" id="info_icon"></span>
                    <span>
                        {$contact_infos.address.address1}<br>
                        {$contact_infos.address.postcode} 
                        {$contact_infos.address.city}<br><br>
                    </span>
                </div>
                
                <div id="double_column">
                    <span class="icon-phone" id="info_icon"><br></span>
                    <span>
                        {$contact_infos.phone}<br>
                    </span>
                </div>

                <div id="double_column">
                    <span class="icon-phone" id="info_icon"><br></span>
                    <span>
                        Paweł  (+48) 603 000 000 <br><br>
                    </span>
                </div>

                <div id="double_column">
                    <span class="icon-envelope" id="info_icon"><br></span>
                    <span>
                        {$contact_infos.email}<br><br>
                    </span>
                </div>


                <div id="double_column">
                    <span class="icon-social-facebook" id="info_icon"><br></span>
                    <span>
                        Nasz profil na facebook.com
                    </span>
                </div>
                
            </span>
        </div>
    </div>
</div>
