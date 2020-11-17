// init vue app
var app = new Vue({
    el: '#app',
    data: {
        offers: [
        ]
    },
    methods: {
        formatPrice(val){
            return val.toFixed(2);
        }
    }
})

// create Http request
var xhr = new XMLHttpRequest();

//xhr has ran
xhr.onload = function () {

    // Process our return data
    if (xhr.status >= 200 && xhr.status < 300) {
        //xhr success
        var response = (JSON.parse(xhr.response));
        if(response.success){
            //recived a success response
            app.offers = response.offers;
        }else{
            console.log(response.message);
        }

    } else {
        //xhr has failed
        console.log('getting offers failed');
    }

};

// send the xhr request
sendRequest = function(sortValue = null){
    //add sirt value if required
    xhr.open('GET', '/api/offers?sortBy='+sortValue);
    //get csrf token to make sure it coming from an expected source
    var token = getCookie('XSRF-TOKEN');
    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    xhr.send();
}


sort = function(){
    //when sort metho is chose get more from the api
    var sortValue = document.getElementById('sort').value;
    sendRequest(sortValue);
}

//helper function to get cookies
getCookie = function(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// send the request to get initial offers.
sendRequest();
