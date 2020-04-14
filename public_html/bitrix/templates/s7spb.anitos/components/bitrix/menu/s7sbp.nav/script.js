// s7sbp.nav

;(function() {
    'use strict';

    window.saleBasket = {


        // top panel
        setScrollTop: function () {
            this.scroll.docTop = window.pageYOffset || document.documentElement.scrollTop;
        },

        getNavTop: function(){
            if(this.scroll.navTop == 0 && $(this.scroll.id).length > 0){
                this.scroll.navTop = $(this.scroll.id).offset().top;
                this.scroll.navTop = $(this.scroll.head).offset().top;
            }
            return this.scroll.navTop;
        },

        toggleNavTop: function(top){
            if(top > this.getNavTop()){
                $(this.scroll.id).addClass(this.scroll.class);
                $(this.scroll.head).addClass(this.scroll.class);
            }else{
                $(this.scroll.id).removeClass(this.scroll.class);
                $(this.scroll.head).removeClass(this.scroll.class);
            }
        },

        // developer tools
        d: function (value) {
            console.log(value);
        }

    };

})();



/**
 * Window event lissener
 */
window.addEventListener("scroll", function(event) {
    //tradeMark.scroll.docTop = this.scrollY;
    window.saleBasket.toggleNavTop(this.scrollY);
}, false);