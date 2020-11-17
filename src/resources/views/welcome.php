<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!--  adding vue js   -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Your Offers
                </div>
                <div class="sort-container">Sort By:
                    <select onchange="sort()" id="sort">
                        <option  default value="0">None</option>
                        <option value="high-low">Cash back - High to Low</option>
                        <option value="low-high">Cash back - Low to High</option>
                        <option value="a-z">A-Z</option>
                        <option value="z-a">Z-A</option>

                    </select>
                </div>

                <div class="offers flex-container" id="app">
                    <div class="offer" v-for="offer in offers">
                        <div class="image"><img :src="offer.image_url"></div>
                        <h3 class="name">{{offer.name}}</h3>
                        <div class="cash-back"><b>Cash Back:</b> ${{formatPrice(offer.cash_back)}}</div>
                    </div>
                </div>

            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
