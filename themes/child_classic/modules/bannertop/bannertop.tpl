<div class="header-banner1" id="bannertop"
    style="background-color: {$backgroundColor};">

    <div class="col-md-3">
    </div>

    <div class="col-md-6" style="height: 100%; text-align: center; margin: auto">
        <div id="banner_tekst">
            {$text nofilter}
        </div>
    </div>  

    <div class="col-md-3">
        <button id="close-button" style="color:{$closeButtonColor|default:'#000000'};"  onclick=closeBanner()>
            &#215;
        </button>
    </div> 
</div> 

<script>
    function closeBanner() {
        var banner = document.querySelector("bannertop");
        bannertop.style.display = "none";
    }
</script>
 
