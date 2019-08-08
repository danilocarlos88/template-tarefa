(function ($, global) {
  $(document).ready(function () {
    var vpWidth = global.viewportSize.getWidth();
    
    $('.btn-banner-click').on('click', function(event){
      var id_banner = $(this).data('id_banner');
      if($(this).data('id_seminovo') != null){
        $('#form-dados-ligamos-para-voce input[type=hidden][name=id_carro_seminovo]').val($(this).data('id_seminovo'));
      }
      $.ajax({
        url: root_rel + 'lua4auto/banners/click/' + id_banner,
        type: 'get'
      });
    });
    
    if($('[data-remodal-id=floater-modal]').length > 0){
        var floater = $('[data-remodal-id=floater-modal]').remodal();
        floater.open();
    }

    $(window).resize(function() {
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 500);
    });

    $(window).bind('resizeEnd', function() {
      $(".compare-cart").css("height", "auto");
      var cartHeight = $(".compare-cart").outerHeight();
      $(".compare-cart").css("height", cartHeight);
      $(".compare-cart").css("margin-bottom", 0);
      vpWidth = global.viewportSize.getWidth();
    });

    $(window).scroll(function() {
      if(vpWidth > 560) {
        var cartHeight = $(".compare-cart").outerHeight();
        var footerToTop = $(".footer").position().top;
        var footerHeight = $(".footer").outerHeight();
        var scrollTop = $(document).scrollTop() + footerHeight;

        if (scrollTop > footerToTop) {
          $(".compare-cart").removeClass("compare-cart--stick");
          $(".compare-cart").css("margin-bottom", -cartHeight);
        } else {
          $(".compare-cart").css("margin-bottom", 0);
          $(".compare-cart").addClass("compare-cart--stick");
        }
      }

      if (vpWidth >= 1200 && $('.page-content').length > 0) {
        var winTop = $(window).scrollTop();
        var pageContentTop = $('.page-content').offset().top;

        var mainH = $('.main').height();
        var sidebarH = $('.sidebar').height();

        var mainSideDiff = mainH - sidebarH - 20; // 20 = main margin-bottom
        var stopPointBottom = pageContentTop + (mainSideDiff);

        if(winTop > pageContentTop && winTop < stopPointBottom) {
          var diff = winTop - pageContentTop;
          $('.sidebar').css('top', diff + 10); // 10 = to give some space from top
        } else if(winTop > stopPointBottom) {
          $('.sidebar').css('top', mainSideDiff);
        } else {
          $('.sidebar').css('top', 0);
        }
      }

    });

  });

  $(function(){
    
    $('body').on('change', '.select-marca', function(){
      var id_marca = $(this).val();
      var $this = $(this);

      if(id_marca != "" && id_marca > 0){
          $.ajax({
          url: root_rel + 'lua4auto/seminovosmodelos/busca/' + id_marca,
          type: 'get',
          beforeSend: function () {
          $this.closest('form').find('.select-modelo').html('<option value="0">Selecione primeiro a marca</option>');
          startLoading();
          },
          dataType: 'json',
          success: function (json) {
            var html = '<option value="">Selecionar modelo</option>';
            $.each(json, function(key, value) {
              if($this.hasClass('marca-busca')) {
                if(value.qtd_carros > 0) {
                  html += '<option value="' + value.id_modelo + '">' + value.descricao + '</option>';
                }
              } else {
                html += '<option value="' + value.id_modelo + '">' + value.descricao + '</option>';
              }
            });
            $this.closest('form').find('.select-modelo').html(html);
            $this.closest('form').find('.select-versao').html('');
            $(".select-chosen").trigger("chosen:updated");
          },
          complete: function () {
            stopLoading();
          }
		});
      }
	});

	$('body').on('change', '.select-modelo', function () {
      var id_modelo = $(this).val();
      var $this = $(this);

      if (id_modelo != "" && id_modelo > 0) {

		$.ajax({
		    url: root_rel + 'lua4auto/seminovosversoes/busca/0/' + id_modelo,
		    type: 'get',
		    beforeSend: function () {
			$this.closest('form').find('.select-versao').html('<option value="0">Selecione primeiro o modelo</option>');
			startLoading();
		    },
		    dataType: 'json',
		    success: function (json) {
			var html = '<option value="">Selecionar versão</option>';
			$.each(json, function (key, value) {
			    if ($this.hasClass('modelo-busca')) {
				if (value.qtd_carros > 0) {
				    html += '<option value="' + value.id_versao + '">' + value.descricao + '</option>';
				}
			    } else {
				html += '<option value="' + value.id_versao + '">' + value.descricao + '</option>';
			    }
			});
			$this.closest('form').find('.select-versao').html(html);
			$(".select-chosen").trigger("chosen:updated");
		    },
		    complete: function () {
			stopLoading();
		    }
		});
      }
	});

    $(".select-chosen").chosen({
      search_contains: true
    });

    $(document).on('opened', '.remodal', function () {
      $('.select-chosen').chosen('destroy');
      $(".select-chosen").chosen({ width: '100%' });
    });


    // Slicknav for mobile menu

    $('.js-menu').slicknav({
      label: '',
      closeOnClick: true,
      init: function() {
        $(".slicknav_btn").html("").append("<span></span>");
        $('.contacts').clone().addClass('contacts--mobile').appendTo('.slicknav_nav');
        $('.social-medias').clone().addClass('social-medias--mobile').appendTo('.slicknav_nav');
      }
    });

    $('.logo').clone().addClass('logo--small').appendTo('.slicknav_menu');

    // sloder Quem Somos
    if ($('.slider-loja').length > 0) {
      var sliderLoja = $('.slider-loja').slick({
        autoplay: true,
        autoplaySpeed: 4000,
      });
    }
    

    // homepage slider
    if ($('.js-main-slider').length > 0) {
      var mainSlider = $('.js-main-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000
      });
    }
    // car-details slider
    if ($('.js-car-slider').length > 0) {
      var carSlider = $('.js-car-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000
      });

      $('.js-car-slider').on('afterChange', function(event, slick, currentSlide){
        $('#open-gallery').data('slide-index', currentSlide);
      });
    }

    if ($('.bx-pager').length > 0) {
      $('.bx-pager').on('click', 'a', function(e) {
        e.preventDefault();
        var sliderToGo = $(this).data('slide-index');
        carSlider.slick('slickGoTo', sliderToGo);
      })
    }

    // Change color of select depending on the option
    $(".js-primary-select").change(function () {
      if ($(this)[0].selectedIndex != 0) {
        $(this).css('color', "black");
      } else {
        $(this).css('color', "#999");
      }
    });

    // IScroll for compare vehicles container
    if($( ".js-compare-vehicles-container" ).length){
      var compareVehiclesScroll = new IScroll('.js-compare-vehicles-container', {
        scrollX: true,
        scrollY: false,
        click: true
      });
    }

    // Misc
    $('.form-validate').validationEngine({
      promptPosition: 'topLeft'
    });

    $('.enviar').removeAttr('disabled');

    $('.form-ajax').ajaxForm({
      dataType: 'json',
      beforeSubmit: function(arr, $form, options){
        $('.enviar').attr('disabled','disabled');
        startLoading();
      },
      success: function(json, status, xhr, form) {
        var id_form = form[0].id;

        if(json.erro != ""){
          alertify.alert(json.erro);
        }else{
          alertify.alert(json.sucesso);
          $('#'+id_form)[0].reset();
        }

        // $(".js-form-content").fadeOut()
        // $(".js-form-confirmation").fadeIn()
      },
      error: function() {
        alertify.alert("Erro ao processar formulário.<br>Tente novamente mais tarde.");
      },
      complete: function(){
        $('.enviar').removeAttr('disabled');
        stopLoading();
      }
    });

    $(".year").mask("9999");
    $(".data").mask("99/99/9999");
    $(".cep").mask("99999-999");
    $(".cpf").mask("999.999.999-99");
    $(".placa_carro").mask("aaa-9999");
    $('.phone_number')
    .mask("(99)9999-9999?9", { placeholder: "" })
    .blur(function (event) {
      var target, phone, element;
      target = (event.currentTarget) ? event.currentTarget : event.srcElement;
      phone = target.value.replace(/\D/g, '');
      element = $(target);
      element.unmask();
      if(phone.length > 10) {
        element.mask("(99)99999-999?9", { placeholder: "" });
      } else {
        element.mask("(99)9999-9999?9", { placeholder: "" });
      }
    });

    $('.money').maskMoney({
      prefix: 'R$ ',
      thousands: '.',
      decimal: ',',
      precision: 2,
      allowZero: true,
      affixesStay: false
    });

    $('.km').maskMoney({
      suffix: ' km',
      thousands: '.',
      decimal: ',',
      precision: 2,
      allowZero: true,
      affixesStay: false
    });

    var altura_pagina = $(document).height();
    $('.loading-wrapper').css('height', altura_pagina + 'px');

    $('body').on('change', '.select-busca-avancada', function(){
      var valor = $(this).val();
      console.log("Valor -> " + valor);
      if(valor != "" && valor != 0){
        $(this).closest('form').submit();
      }
    })

    // Set file upload name on input

    var input, label;

    $(document).on('change', '.file-upload__btn :file', function() {
      var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
    });

    $('.file-upload__btn :file').on('fileselect', function(e, label) {
      $(".file-upload__name").val(label);
    });

  });

  window.onload = function () {
    $('input, textarea').placeholder({customClass: 'placeholder'});
  }
})(jQuery, window)


function startLoading(){
	$('.loading-wrapper').stop(true, true).fadeIn();
}

function stopLoading(){
	$('.loading-wrapper').stop(true, true).fadeOut('fast');
}