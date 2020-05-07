;(function() {
    'use strict';

    window.saleBasket = {

        basket: {
            id: "#anitos-basket"
        },
        item: {
            class: ".basket-item",
            current: null
        },
        format: {
            ceil: 0,
            duration: 500
        },
        share: {
            id: "element-share",
            active: "d-none"
        },
        article: {
            alert: null,
            action: "/system/search/article.php",
            form: null,
            data: [],
        },
        obPopupWin: null,

        /**
         * Article
         */
        articleShowForm: function(t){

            var popupContent = '<form onsubmit="return saleBasket.articleSubmit(this)">';
            popupContent += '<div class="alert py2 mb2 d-none"></div>';
            popupContent += '<div class="form-group">';
            popupContent += '<lable class="pb1">' + $(t).data("input") + ':</lable>';
            popupContent += '<input type="text" class="form-control my3" name="article">';
            popupContent += '</div>';
            popupContent += '<input type="submit" class="btn btn-danger" value="' + $(t).data("btn-yes") + '" />';
            popupContent += '</form>';



            this.obPopupWin = BX.PopupWindowManager.create('multiplebasket_popup', null, {
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                overlay : true,
                closeByEsc: true,
                titleBar: true,
                content: popupContent,
                closeIcon: true,
                contentColor: 'white',
                className: "multiplebasketPopup",
            });

            this.obPopupWin.setTitleBar($(t).data("title"));
            //this.obPopupWin.setContent(popupContent);
            this.obPopupWin.show();

            return false;
        },

        articleSubmit: function (t) {

            this.article.form = $(t);
            this.article.data = this.article.form.serializeArray();
            this.article.alert = this.article.form.find(".alert");
            this.article.alert.removeClass("alert-success")
                              .removeClass("alert-danger")
                              .removeClass("d-none")
                              .html("Загрузка ...");

            disableElement(this.article.form.find('input[type="submit"]'));

            $.getJSON(this.article.action, this.article.data, function (data) {

                if(data.length > 0){
                    saleBasket.article.alert.addClass("alert-success").html("Товар по добавлен в корзину!");

                    var request = BX.ajax.runAction('studio7spb:marketplace.api.tools.addToBasket', {
                        data: {
                            id: data.ID,
                            quantity: 1
                        }
                    });
                    request.then(function(response){
                        if(response.status == 'success') {

                            //BX.onCustomEvent('OnBasketChange');
                        }
                    });


                }else{
                    saleBasket.article.alert.addClass("alert-danger").html("Товар по такому артиклу не найден!");
                }

                saleBasket.d(data);

                enableElement(saleBasket.article.form.find('input[type="submit"]'));

            });

            return false;
        },

        /**
         * Toggle share panel
         */
        toggleShare: function () {
            if(BX.hasClass(BX(this.share.id), this.share.active)){
                BX.removeClass(BX(this.share.id), this.share.active);
            }else{
                BX.addClass(BX(this.share.id), this.share.active);
            }
            return false;
        },

        /**
         * Counter
         * @param t
         * @param type
         */
        count: function(t, type){

            if(type === true){
                quantityCounter.up(t);
            }
            if(type === false){
                quantityCounter.down(t);
            }


            var counter = $(t).parent(),
                input = counter.find("input"),
                value = parseInt(input.val()),
                price = counter.data("price"),

                item = $(t).closest(this.item.class),
                itemSum = item.find(".item-sum");



            //price = price.toFixed(saleBasket.format.ceil);
            price = parseFloat(price);
            price = price * value;
            this.updateRow(t, {
                price: price,
                currency: counter.data("currency")
            });

            //this.animateInput(input, value);
            this.total({
                price: 0,
                currency: counter.data("currency")
            });

            // save data
            BX.ajax.runAction('studio7spb:marketplace.api.tools.counterBasket', {
                data: {
                    id: item.data("product"),
                    quantity: value
                }
            });

        },

        /**
         * Update row price
         * @param t
         * @param data
         */
        updateRow: function(t, data){
            $(t).closest(".basket-item").find(".basket-sum").html(this.priceFormat(data));
        },

        /**
         * Calculate total
         * @param data
         */
        total: function(data){

            var basket = $("#anitos-basket"),
                price = 0;

            if(basket.find(".quantity-counter").length > 0){
                basket.find(".quantity-counter").each(function () {
                    price = parseFloat($(this).data("price"))  * parseInt($(this).find("input").val());
                    data.price += price;
                });

                $("#allSum").text(this.priceFormat(data));

            }
            else{
                this.basketEmpty();
            }

        },

        priceFormat: function(data){
            var priceFormat = data.price,
                currency = data.currency;

            priceFormat = priceFormat.toFixed(2);
            priceFormat = "" + priceFormat;
            priceFormat = priceFormat.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            priceFormat = currency.replace("#", priceFormat);

            return priceFormat;
        },

        toggleFavorite: function (t, id) {

            // lighting
            if($(t).hasClass("item-favorite-icon")){
                $(t).removeClass("item-favorite-icon");
                $(t).addClass("item-favorite-fill");
            }else{
                $(t).removeClass("item-favorite-fill");
                $(t).addClass("item-favorite-icon");
            }

            this.item.current = t;
            //this.remove();

            // sent data
            var request = BX.ajax.runAction('studio7spb:marketplace.api.tools.addToWish', {
                data: {
                    id: id,
                }
            });
            request.then(function(response){
                if(response.status == 'success') {
                    //s7market.updateBasket();
                }
            });


        },

        /**
         * <td class="cursor-pointer border-bottom border-gray"
             onclick="saleBasket.delete(this)"
             data-title="Вы уверены что хотите удалить товар из корзины?"
             data-delete="Да, удалить" data-cancel="Нет, оставить товар в корзине" title="Удалить">
             <i class="icon-delete"></i>
             </td>
         *
         * Delete dialog
         * @param t
         *
         */
        delete: function (t) {
            //if (this.obPopupWin)
            //    return;

            this.item.current = $(t).closest(this.item.class);

            var popupContent = this.item.current.find(".basket-item-info");
            popupContent = popupContent.clone();
            popupContent.find("a")
                .addClass("d-block")
                .addClass("mb3")
                .addClass("text-center");
            popupContent = popupContent.html();

            this.obPopupWin = BX.PopupWindowManager.create('multiplebasket_popup', null, {
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                overlay : true,
                closeByEsc: true,
                titleBar: true,
                content: popupContent,
                closeIcon: true,
                contentColor: 'white',
                className: "multiplebasketPopup",
                buttons: [
                    new BX.PopupWindowButton({
                        'text': $(t).data("delete"),
                        'events': {
                            'click': function ()
                            {
                                saleBasket.removeBasketItem($(t).data("id"));
                                saleBasket.obPopupWin.close();
                            }
                        }
                    }),
                    new BX.PopupWindowButton({
                        'text': $(t).data("cancel"),
                        'events': {
                            'click': function ()
                            {
                                saleBasket.obPopupWin.close();
                            }
                        }
                    }),
                ]
            });

            this.obPopupWin.setTitleBar($(t).data("title"));
            //this.obPopupWin.setContent(popupContent);
            this.obPopupWin.show();
        },

        /**
         * Confirm remove basket
         * @param basketId
         */
        removeBasketItem: function(basketId){
            this.item.current.remove();
            var count = $(this.basket.id).find(this.item.class).length;

            // send data
            var request = BX.ajax.runAction('studio7spb:marketplace.api.tools.deleteBasket', {
                    data: {
                        id: basketId
                    }
                });

            // request.then(function(response){
            //    s7market.updateBasket();
            // });

            // check basket items if it empty - close basket and show empty
            // if not -recalculate
            if(count > 0) {
                this.recalculate();
            }
            else{
                this.basketEmpty();
            }

        },

        /**
         * Clear basket and show empty
         */
        basketEmpty: function(){
            var empty = this.basketEmptyHtml($(this.basket.id).data("empty"));
            $(this.basket.id).html(empty);
        },

        basketEmptyHtml: function(html){
            var empty = BX.create('div', {
                props: { className: "alert alert-info text-center mb5" },
                children: [
                    BX.create('img', {
                        props: {
                            className: "mb3",
                            src: $(this.basket.id).data("emptyimg")
                        }
                    }),
                    BX.create('div', {
                        html: html
                    })
                ]
            });
            return empty;
        },

        /**
         * Recalculate shell
         */
        recalculate: function(){
            this.total({
                price: 0,
                currency: $(this.basket.id).data("currency")
            });
        },

        /**
         * Selector functions
         */
        selector: function(t){
            if($(t).is(':checked')){
                this.selectAllItems();
            }else{
                this.unSelectAllItems();
            }
        },

        selectAllItems: function(){

            var basket = $(this.basket.id),
                products = basket.find(".product-selector");

            if(products.length > 0){
                products.each(function () {
                    $(this).attr('checked','checked');
                });

            }


        },

        unSelectAllItems: function(){

            var basket = $(this.basket.id),
                products = basket.find(".product-selector");

            if(products.length > 0){
                products.each(function () {
                    $(this).attr('checked',null);
                });

            }

        },

        deleteSelectedConfirm: function(t){

            this.obPopupWin = BX.PopupWindowManager.create('multiplebasket_popup', null, {
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                overlay : true,
                closeByEsc: true,
                titleBar: true,
                content: $(t).data("desc"),
                closeIcon: true,
                contentColor: 'white',
                className: "multiplebasketPopup",
                buttons: [
                    new BX.PopupWindowButton({
                        'text': $(t).data("delete"),
                        'events': {
                            'click': function ()
                            {
                                saleBasket.deleteSelected();
                                saleBasket.obPopupWin.close();
                            }
                        }
                    }),
                    new BX.PopupWindowButton({
                        'text': $(t).data("cancel"),
                        'events': {
                            'click': function ()
                            {
                                saleBasket.obPopupWin.close();
                            }
                        }
                    }),
                ]
            });

            this.obPopupWin.setTitleBar($(t).data("title"));
            //this.obPopupWin.setContent(popupContent);
            this.obPopupWin.show();
        },

        deleteSelected: function(){

            var basket = $(this.basket.id),
                products = basket.find(".product-selector"),
                i = 0;

            if(products.length > 0){
                products.each(function () {
                    if($(this).is(':checked')){
                        i++;

                        $(this).parent().parent().remove();

                        // send data
                        BX.ajax.runAction('studio7spb:marketplace.api.tools.deleteBasket', {
                            data: {
                                id: this.value
                            }
                        });
                    }
                });

            }

            if(i >= products.length)
            {
                this.basketEmpty();
            }


        },

        favoriteSelected: function(){
            // toggleFavorite: function (t, id)
            var basket = $(this.basket.id),
                products = basket.find(".product-selector");

            if(products.length > 0){
                products.each(function () {
                    if($(this).is(':checked')){
                        $(this).parent().parent().find(".item-favorite-btn").click();
                    }
                });

            }
        },

        /**
         * developer tools
         */
        d: function (value) {
            console.log(value);
        }
    };

})();


/**
 * multiplebasket Popup
 */

multiplebasketPopup = {

    obPopupWin: null,

    initPopupWindow: function()
    {
        if (this.obPopupWin)
            return;

        this.obPopupWin = BX.PopupWindowManager.create('multiplebasket_popup', null, {
            autoHide: true,
            offsetLeft: 0,
            offsetTop: 0,
            overlay : true,
            closeByEsc: true,
            titleBar: true,
            closeIcon: true,
            contentColor: 'white',
            className: "multiplebasketPopup",
        });
    },

    open: function (t) {

        this.initPopupWindow();

        var popupContent = '<form onsubmit="return multiplebasketPopup.submit(this)">';
        popupContent += '<div class="alert d-none"></div>';
        popupContent += '<div class="form-group">';
        popupContent += '<lable class="pb3">Введите название корзины</lable>';
        popupContent += '<input type="text" class="form-control my3" name="name">';
        //popupContent += '<small id="emailHelp" class="form-text text-muted">Имя корзины поможет легко найти её в списке</small>';
        popupContent += '</div>';
        popupContent += '<input type="submit" class="btn btn-danger" value="Сохранить" />';
        popupContent += '</form>';

        this.obPopupWin.setTitleBar("Сохранение корзины");
        this.obPopupWin.setContent(popupContent);
        this.obPopupWin.show();

        return false;
    },

    submit: function (t) {
        var form = $(t),
            data = form.serializeArray(),
            action = "/system/7studio/sale/multiplebasket/procedures/add.php";

        form.find(".alert").addClass("d-none");
        $.getJSON(action, data, function (result) {

            if(result.type == "success"){
                //location.href = "/basket/";
                saleBasket.basketEmpty();
                multiplebasketPopup.obPopupWin.setTitleBar(result.title);
                multiplebasketPopup.obPopupWin.setContent(saleBasket.basketEmptyHtml(result.text));

            }else{
                form.find(".alert")
                    .removeClass("d-none")
                    .removeClass("alert-danger")
                    .removeClass("alert-success")
                    .addClass("alert-" + result.type)
                    .html(result.text);
            }

        });

        return false;
    }
};