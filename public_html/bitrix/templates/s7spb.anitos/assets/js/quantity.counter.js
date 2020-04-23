var quantityCounter = {

    counter: null,
    input: null,
    value: null,

    initCounter: function(t) {
        this.counter = t.parentNode;
        this.input = BX.findChildren(this.counter, {tagName: 'input'}, false);
        if (!!this.input && this.input.length > 0)
        {
            this.input = this.input[0];
        }
        this.value = this.input.value;
        this.value = parseInt(this.value);
        if(this.value <= 0){
            this.value = 1;
        }
    },

    up: function (t) {
        this.initCounter(t);
        this.value++;
        this.input.value = this.value;

    },

    down: function (t) {
        this.initCounter(t);
        this.value--;
        if(this.value <= 0){
            this.value = 1;
        }
        this.input.value = this.value;

    },

    d: function (value) {
        console.info(value);
    }

};