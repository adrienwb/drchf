/*
 *
 * Requires jQuery and jQuery Rest
 */
api = {
    url : '/api',
    options : {
        u:'js',
        p:'d3r3ch3f',
        k:'',
        l:'fr_FR'
    },
    dataType:'json',
    init: function(options,callback){
        $.extend(this.options, options);
    },
    call:function(http_method,action,params,callback){
        params = $.extend(this.options, params);
        var endpoint = this.url + action;
        $.ajax({
            url: endpoint,
            type: http_method,
            dataType: this.dataType,
            data: params,
            mode : 'abort',
            async : true,
            xhrFields: {
                withCredentials: true
            },
            port: 80,
            success: function(data) {
                if (callback){
                    callback(data.result);
                }
            },
            complete : this._complete,
            error: function(data){
                console.log(data);
            }
        });
    },

    _complete: function(jqXHR, textStatus) {
        //console.log("COMPLETE : api - " + textStatus );
    }

}