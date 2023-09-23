{*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.

* <button id="arrow_button"><img id="arrow_img_right"></img></button>

*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{debug}
<section>
  <h1 id="product_h1">{l s='Promocje' d='Modules.Specials.Shop'}</h1>
    <div id="product_panel">
      <nav class="arrow_img prev"></nav>
        <div class="products" id="products_container">
            {foreach from=$products item="product"}
             
              {include file="catalog/_partials/miniatures/product.tpl" product=$product}

            {/foreach}
        </div>
      <nav class="arrow_img next"></nav>
    </div>
  <a href="{$allSpecialProductsLink}">{l s='All sale products' d='Modules.Specials.Shop'}</a>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const productContainer = document.getElementById("products_container");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");
    const step = 200; // Dostosuj wartość przewijania do swoich potrzeb

    prevButton.addEventListener("click", function () {
        productContainer.scrollLeft -= step;
    });

    nextButton.addEventListener("click", function () {
        productContainer.scrollLeft += step;
    });
  });
</script>