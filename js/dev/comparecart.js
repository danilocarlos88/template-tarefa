(function( $ ) {
  $.CompareCart = function( element ) {
    this.$element = $( element );
    this.init();
  };

  $.CompareCart.prototype = {
    init: function() {

      this.cartName = "compare-cart";
      this.storage = sessionStorage;

      this.createCart();
      this.populateCart();
      this.addCar();
      this.removeCar();
      this.populateVacantCars();
      this.submitCart();
      this.toggleCart();
      this.clear();

      if(!this.isEmpty()) {
        this.showCart();
      }

    },

    createCart: function() {
      if( this.storage.getItem( this.cartName ) == null ) {
        var cart = [];

        this.storage.setItem( this.cartName, this._toJSONString( cart ) );
      }
    },

    addCar: function() {
      var self = this;


      this.$element.find(".compare-cart-add").on("click", function() {

        self.showCart();

        var car = $(this).parent(),
            id = car.data("car-id"),
            name = car.find(".car__name").text(),
            img = car.find(".car__figure img").attr("src");

        car = {
          id: id,
          name: name,
          img: img
        }

        if( self._carIsOnCart( parseInt(car.id) ) ) {
          swal({
            title: "Este carro já foi adicionado.",
            confirmButtonColor: "#0dc143"
          });          
        } else if (self._cartIsOnLimit()) {
          swal({
            title: "Não há espaço para adicionar um novo carro.",
            confirmButtonColor: "#0dc143"
          });
        }
        else {
          self._addToCart( car );
          self.populateCart();
          self.populateVacantCars();
        }

      });

    },

    populateCart: function() {
      self = this;

      if( this.storage.getItem( this.cartName ) != null ) {

        var cartList = this._toJSONObject( this.storage.getItem( this.cartName ));

        if( $(".compare-cart-car.vacant").length == 3 ) {
          $.each(cartList, function(index, car) {
            self._appendCar(index, car);
          });
        } else {
          var carsOnDom = [];
          $(".compare-cart-car").each(function(index, item) {
            if ($(this).attr("data-compare-car-id")) {
              carsOnDom.push(parseInt($(this).attr("data-compare-car-id")));
            }
          });

          $.each(cartList, function(index, car) {
            if ($.inArray(car.id, carsOnDom) == -1) {
              self._appendCar(index, car);
            }

          });          
        }
      
      }
    },

    removeCar: function() {
      var self = this;

      $("body").on("click", ".compare-cart-remove", function(e) {
        e.preventDefault();

        var carId = $(this).data("car-id");
        self.destroyCar(carId);

        if (self.isEmpty()) {
          self.hideCart();
        } else {
          self.populateVacantCars();
        }

      });

    },

    destroyCar: function(id) {
      var $car = $('.compare-cart-car[data-compare-car-id="' + id + '"]');

      var cart = self.storage.getItem( self.cartName );
      var cartList = self._toJSONObject( cart );
      var index = null;

      for(var i in cartList) {
        if (cartList[i].id == id) {
          index = i;
        }
      }

      console.log("DESTROY CAR", cartList);
      cartList.splice(index, 1);

      self.storage.setItem( self.cartName, self._toJSONString( cartList ) );

      console.log("ADICIONAR VAGA", $car);
      $car.addClass("vacant");
      $car.removeAttr("data-compare-car-id");
    },

    populateVacantCars: function() {
      var vacantCars = $(".compare-cart-car.vacant"),
          total = vacantCars.length,
          amount = total > 1 ? "dois carros" : "um carro";

      var html = "<img src='http://placehold.it/360x230'alt='Carro'>";
          html += "<h2>Você pode selecionar mais ";
          html += amount;
          html += " para comparar.</h2>"

      vacantCars.each(function(index, car) {
        $(car).html("");
        $(car).append(html);
      });
    },

    isEmpty: function() {
      var cartList = this._toJSONObject( this.storage.getItem( this.cartName ));
      return cartList.length == 0;
    },

    showCart: function() {
      if(viewportSize.getWidth() > 560) {
        $( ".compare-cart+.footer" ).animate({
          marginTop: $(".compare-cart").outerHeight()
        }, 100, function() {
          $(".compare-cart").slideDown(150);
        });
      } else if( $( ".compare-cart" ).hasClass("minimized") ) {
        $( ".compare-cart" ).animate({
          bottom: 0
        }, 200);
        $( ".compare-cart" ).removeClass("minimized");
      } else {
        $(".compare-cart").slideDown(150);
      }
    },

    hideCart: function() {
      if(viewportSize.getWidth() > 560) {
        $(".compare-cart").slideUp(250, function() {
          $( ".compare-cart+.footer" ).animate({
            marginTop: 0
          }, 200); 
        });
      } else {
        $(".compare-cart").slideUp(250);
      }
    },

    toggleCart: function() {
      $(".compare-cart-toggle").on("click", function(e) {
        e.preventDefault();
        var downTo = -($(".compare-cart").outerHeight()-30);
        
        if( $( ".compare-cart" ).hasClass("minimized") ) {
          $( ".compare-cart" ).animate({
            bottom: 0
          }, 200);
          $( ".compare-cart" ).removeClass("minimized");
        } else {
          $( ".compare-cart" ).animate({
            bottom: downTo
          }, 200);
          $( ".compare-cart" ).addClass("minimized");
        }
      });
    },

    submitCart: function() {
      $(".compare-cart-form").submit(function() {
        var cartLength = (JSON.parse(sessionStorage.getItem("compare-cart"))).length;   // <<< Rever isso aqui
        if(cartLength < 2) {
          swal({
            title: "É necessário adicionar no mínimo mais um carro.",
            confirmButtonColor: "#FFD300"
          });
          return false;
        }
        sessionStorage.removeItem("compare-cart");
        return true;
      });
    },


    clear: function() {
      var self = this;

      $(".js-clear-cart").on('click', function() {

        $.each( $('.compare-cart-car'), function( i, el ){
          var id = $(el).attr('data-compare-car-id');
          if(typeof id != 'undefined') {
            self.destroyCar(id);
          }
        }).promise().done( function(){
          self.populateVacantCars();
          self.hideCart();
        });

        return false;
      });
    },

    _toJSONString: function( obj ) {
      var str = JSON.stringify( obj );
      return str;
    },

    _toJSONObject: function( str ) {
      var obj = JSON.parse( str );
      return obj;
    },

     _carIsOnCart: function(id) {
      var ids = [];
      var cartList = this._toJSONObject( this.storage.getItem( this.cartName ));

      $.each(cartList, function(index, item) {
        ids.push(item.id);
      });

      return $.inArray(id, ids) != -1;
    },

    _cartIsOnLimit: function() {
      var cartList = this._toJSONObject( this.storage.getItem( this.cartName ));
      return cartList.length == 3;
    },

    _addToCart: function( obj ) {
      var cart = this.storage.getItem( this.cartName );

      var cartList = this._toJSONObject( cart );
      cartList.push( obj );
      
      if (cartList.length <= 3)
        this.storage.setItem( this.cartName, this._toJSONString( cartList ) );
      else
        alert("fechou! volte mais tarde");
    },

    _appendCar: function(index, obj) {
      var car = $(".compare-cart-car.vacant").first();

      var html = "";
      html += "<img src='" + obj.img + "' alt='" + obj.name + "'>"
      html += "<h2>" + obj.name + "</h2>";
      html += "<button class='compare-cart-remove' data-car-id='" + obj.id  +"'></button>";
      //html += "<input type='hidden' name='car-" + $(".compare-cart-car").index(car) + "' value='" + obj.id + "'>";
      html += "<input type='hidden' name='cars[]' value='" + obj.id + "'>";


      car.html("");
      car.attr("data-compare-car-id", obj.id);
      car.append(html);
      car.removeClass("vacant");      
    }
  };

  $(function() {
    if($('.car-showcase').length > 0) {
      var compareCart = new $.CompareCart( ".car-showcase" );
    }
  });

})( jQuery );
