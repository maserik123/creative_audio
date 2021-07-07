<?php
$username = $this->session->userdata('nama');
$level = $this->session->userdata('level');
$kode = $this->session->userdata('kode');
$email = $this->session->userdata('email');
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creative Audio Pekanbaru</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/bootstrap.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/font-awesome.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/elegant-icons.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/nice-select.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/jquery-ui.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/owl.carousel.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/slicknav.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/ecommerce/css/style.css'); ?>" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <script type='text/javascript'>
        //<![CDATA[
        ! function(e, t) {
            "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define("Siema", [], t) : "object" == typeof exports ? exports.Siema = t() : e.Siema = t()
        }(this, function() {
            return function(e) {
                function t(s) {
                    if (i[s]) return i[s].exports;
                    var r = i[s] = {
                        i: s,
                        l: !1,
                        exports: {}
                    };
                    return e[s].call(r.exports, r, r.exports, t), r.l = !0, r.exports
                }
                var i = {};
                return t.m = e, t.c = i, t.i = function(e) {
                    return e
                }, t.d = function(e, i, s) {
                    t.o(e, i) || Object.defineProperty(e, i, {
                        configurable: !1,
                        enumerable: !0,
                        get: s
                    })
                }, t.n = function(e) {
                    var i = e && e.__esModule ? function() {
                        return e.default
                    } : function() {
                        return e
                    };
                    return t.d(i, "a", i), i
                }, t.o = function(e, t) {
                    return Object.prototype.hasOwnProperty.call(e, t)
                }, t.p = "", t(t.s = 0)
            }([function(e, t, i) {
                "use strict";

                function s(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }
                Object.defineProperty(t, "__esModule", {
                    value: !0
                });
                var r = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                        return typeof e
                    } : function(e) {
                        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                    },
                    n = function() {
                        function e(e, t) {
                            for (var i = 0; i < t.length; i++) {
                                var s = t[i];
                                s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(e, s.key, s)
                            }
                        }
                        return function(t, i, s) {
                            return i && e(t.prototype, i), s && e(t, s), t
                        }
                    }(),
                    o = function() {
                        function e(t) {
                            var i = this;
                            s(this, e), this.config = e.mergeSettings(t), this.selector = "string" == typeof this.config.selector ? document.querySelector(this.config.selector) : this.config.selector, this.selectorWidth = this.selector.offsetWidth, this.innerElements = [].slice.call(this.selector.children), this.currentSlide = this.config.startIndex, this.transformProperty = e.webkitOrNot(), ["resizeHandler", "touchstartHandler", "touchendHandler", "touchmoveHandler", "mousedownHandler", "mouseupHandler", "mouseleaveHandler", "mousemoveHandler"].forEach(function(e) {
                                i[e] = i[e].bind(i)
                            }), this.init()
                        }
                        return n(e, [{
                            key: "init",
                            value: function() {
                                if (window.addEventListener("resize", this.resizeHandler), this.config.draggable && (this.pointerDown = !1, this.drag = {
                                        startX: 0,
                                        endX: 0,
                                        startY: 0,
                                        letItGo: null
                                    }, this.selector.addEventListener("touchstart", this.touchstartHandler, {
                                        passive: !0
                                    }), this.selector.addEventListener("touchend", this.touchendHandler), this.selector.addEventListener("touchmove", this.touchmoveHandler, {
                                        passive: !0
                                    }), this.selector.addEventListener("mousedown", this.mousedownHandler), this.selector.addEventListener("mouseup", this.mouseupHandler), this.selector.addEventListener("mouseleave", this.mouseleaveHandler), this.selector.addEventListener("mousemove", this.mousemoveHandler)), null === this.selector) throw new Error("Something wrong with your selector ");
                                this.resolveSlidesNumber(), this.selector.style.overflow = "hidden", this.sliderFrame = document.createElement("div"), this.sliderFrame.style.width = this.selectorWidth / this.perPage * this.innerElements.length + "px", this.sliderFrame.style.webkitTransition = "all " + this.config.duration + "ms " + this.config.easing, this.sliderFrame.style.transition = "all " + this.config.duration + "ms " + this.config.easing, this.config.draggable && (this.selector.style.cursor = "-webkit-grab");
                                for (var e = document.createDocumentFragment(), t = 0; t < this.innerElements.length; t++) {
                                    var i = document.createElement("div");
                                    i.style.cssFloat = "left", i.style.float = "left", i.style.width = 100 / this.innerElements.length + "%", i.appendChild(this.innerElements[t]), e.appendChild(i)
                                }
                                this.sliderFrame.appendChild(e), this.selector.innerHTML = "", this.selector.appendChild(this.sliderFrame), this.slideToCurrent(), this.config.onInit.call(this)
                            }
                        }, {
                            key: "resolveSlidesNumber",
                            value: function() {
                                if ("number" == typeof this.config.perPage) this.perPage = this.config.perPage;
                                else if ("object" === r(this.config.perPage)) {
                                    this.perPage = 1;
                                    for (var e in this.config.perPage) window.innerWidth >= e && (this.perPage = this.config.perPage[e])
                                }
                            }
                        }, {
                            key: "prev",
                            value: function() {
                                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 1,
                                    t = arguments[1];
                                if (!(this.innerElements.length <= this.perPage)) {
                                    var i = this.currentSlide;
                                    0 === this.currentSlide && this.config.loop ? this.currentSlide = this.innerElements.length - this.perPage : this.currentSlide = Math.max(this.currentSlide - e, 0), i !== this.currentSlide && (this.slideToCurrent(), this.config.onChange.call(this), t && t.call(this))
                                }
                            }
                        }, {
                            key: "next",
                            value: function() {
                                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 1,
                                    t = arguments[1];
                                if (!(this.innerElements.length <= this.perPage)) {
                                    var i = this.currentSlide;
                                    this.currentSlide === this.innerElements.length - this.perPage && this.config.loop ? this.currentSlide = 0 : this.currentSlide = Math.min(this.currentSlide + e, this.innerElements.length - this.perPage), i !== this.currentSlide && (this.slideToCurrent(), this.config.onChange.call(this), t && t.call(this))
                                }
                            }
                        }, {
                            key: "goTo",
                            value: function(e, t) {
                                if (!(this.innerElements.length <= this.perPage)) {
                                    var i = this.currentSlide;
                                    this.currentSlide = Math.min(Math.max(e, 0), this.innerElements.length - this.perPage), i !== this.currentSlide && (this.slideToCurrent(), this.config.onChange.call(this), t && t.call(this))
                                }
                            }
                        }, {
                            key: "slideToCurrent",
                            value: function() {
                                this.sliderFrame.style[this.transformProperty] = "translate3d(-" + this.currentSlide * (this.selectorWidth / this.perPage) + "px, 0, 0)"
                            }
                        }, {
                            key: "updateAfterDrag",
                            value: function() {
                                var e = this.drag.endX - this.drag.startX,
                                    t = Math.abs(e),
                                    i = Math.ceil(t / (this.selectorWidth / this.perPage));
                                e > 0 && t > this.config.threshold && this.innerElements.length > this.perPage ? this.prev(i) : e < 0 && t > this.config.threshold && this.innerElements.length > this.perPage && this.next(i), this.slideToCurrent()
                            }
                        }, {
                            key: "resizeHandler",
                            value: function() {
                                this.resolveSlidesNumber(), this.selectorWidth = this.selector.offsetWidth, this.sliderFrame.style.width = this.selectorWidth / this.perPage * this.innerElements.length + "px", this.slideToCurrent()
                            }
                        }, {
                            key: "clearDrag",
                            value: function() {
                                this.drag = {
                                    startX: 0,
                                    endX: 0,
                                    startY: 0,
                                    letItGo: null
                                }
                            }
                        }, {
                            key: "touchstartHandler",
                            value: function(e) {
                                e.stopPropagation(), this.pointerDown = !0, this.drag.startX = e.touches[0].pageX, this.drag.startY = e.touches[0].pageY
                            }
                        }, {
                            key: "touchendHandler",
                            value: function(e) {
                                e.stopPropagation(), this.pointerDown = !1, this.sliderFrame.style.webkitTransition = "all " + this.config.duration + "ms " + this.config.easing, this.sliderFrame.style.transition = "all " + this.config.duration + "ms " + this.config.easing, this.drag.endX && this.updateAfterDrag(), this.clearDrag()
                            }
                        }, {
                            key: "touchmoveHandler",
                            value: function(e) {
                                e.stopPropagation(), null === this.drag.letItGo && (this.drag.letItGo = Math.abs(this.drag.startY - e.touches[0].pageY) < Math.abs(this.drag.startX - e.touches[0].pageX)), this.pointerDown && this.drag.letItGo && (this.drag.endX = e.touches[0].pageX, this.sliderFrame.style.webkitTransition = "all 0ms " + this.config.easing, this.sliderFrame.style.transition = "all 0ms " + this.config.easing, this.sliderFrame.style[this.transformProperty] = "translate3d(" + -1 * (this.currentSlide * (this.selectorWidth / this.perPage) + (this.drag.startX - this.drag.endX)) + "px, 0, 0)")
                            }
                        }, {
                            key: "mousedownHandler",
                            value: function(e) {
                                e.preventDefault(), e.stopPropagation(), this.pointerDown = !0, this.drag.startX = e.pageX
                            }
                        }, {
                            key: "mouseupHandler",
                            value: function(e) {
                                e.stopPropagation(), this.pointerDown = !1, this.selector.style.cursor = "-webkit-grab", this.sliderFrame.style.webkitTransition = "all " + this.config.duration + "ms " + this.config.easing, this.sliderFrame.style.transition = "all " + this.config.duration + "ms " + this.config.easing, this.drag.endX && this.updateAfterDrag(), this.clearDrag()
                            }
                        }, {
                            key: "mousemoveHandler",
                            value: function(e) {
                                e.preventDefault(), this.pointerDown && (this.drag.endX = e.pageX, this.selector.style.cursor = "-webkit-grabbing", this.sliderFrame.style.webkitTransition = "all 0ms " + this.config.easing, this.sliderFrame.style.transition = "all 0ms " + this.config.easing, this.sliderFrame.style[this.transformProperty] = "translate3d(" + -1 * (this.currentSlide * (this.selectorWidth / this.perPage) + (this.drag.startX - this.drag.endX)) + "px, 0, 0)")
                            }
                        }, {
                            key: "mouseleaveHandler",
                            value: function(e) {
                                this.pointerDown && (this.pointerDown = !1, this.selector.style.cursor = "-webkit-grab", this.drag.endX = e.pageX, this.sliderFrame.style.webkitTransition = "all " + this.config.duration + "ms " + this.config.easing, this.sliderFrame.style.transition = "all " + this.config.duration + "ms " + this.config.easing, this.updateAfterDrag(), this.clearDrag())
                            }
                        }, {
                            key: "updateFrame",
                            value: function() {
                                this.sliderFrame = document.createElement("div"), this.sliderFrame.style.width = this.selectorWidth / this.perPage * this.innerElements.length + "px", this.sliderFrame.style.webkitTransition = "all " + this.config.duration + "ms " + this.config.easing, this.sliderFrame.style.transition = "all " + this.config.duration + "ms " + this.config.easing, this.config.draggable && (this.selector.style.cursor = "-webkit-grab");
                                for (var e = document.createDocumentFragment(), t = 0; t < this.innerElements.length; t++) {
                                    var i = document.createElement("div");
                                    i.style.cssFloat = "left", i.style.float = "left", i.style.width = 100 / this.innerElements.length + "%", i.appendChild(this.innerElements[t]), e.appendChild(i)
                                }
                                this.sliderFrame.appendChild(e), this.selector.innerHTML = "", this.selector.appendChild(this.sliderFrame), this.slideToCurrent()
                            }
                        }, {
                            key: "remove",
                            value: function(e, t) {
                                if (e < 0 || e >= this.innerElements.length) throw new Error("Item to remove doesn't exist ");
                                this.innerElements.splice(e, 1), this.currentSlide = e <= this.currentSlide ? this.currentSlide - 1 : this.currentSlide, this.updateFrame(), t && t.call(this)
                            }
                        }, {
                            key: "insert",
                            value: function(e, t, i) {
                                if (t < 0 || t > this.innerElements.length + 1) throw new Error("Unable to inset it at this index ");
                                if (-1 !== this.innerElements.indexOf(e)) throw new Error("The same item in a carousel? Really? Nope ");
                                this.innerElements.splice(t, 0, e), this.currentSlide = t <= this.currentSlide ? this.currentSlide + 1 : this.currentSlide, this.updateFrame(), i && i.call(this)
                            }
                        }, {
                            key: "prepend",
                            value: function(e, t) {
                                this.insert(e, 0), t && t.call(this)
                            }
                        }, {
                            key: "append",
                            value: function(e, t) {
                                this.insert(e, this.innerElements.length + 1), t && t.call(this)
                            }
                        }, {
                            key: "destroy",
                            value: function() {
                                var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
                                    t = arguments[1];
                                if (window.removeEventListener("resize", this.resizeHandler), this.selector.style.cursor = "auto", this.selector.removeEventListener("touchstart", this.touchstartHandler), this.selector.removeEventListener("touchend", this.touchendHandler), this.selector.removeEventListener("touchmove", this.touchmoveHandler), this.selector.removeEventListener("mousedown", this.mousedownHandler), this.selector.removeEventListener("mouseup", this.mouseupHandler), this.selector.removeEventListener("mouseleave", this.mouseleaveHandler), this.selector.removeEventListener("mousemove", this.mousemoveHandler), e) {
                                    for (var i = document.createDocumentFragment(), s = 0; s < this.innerElements.length; s++) i.appendChild(this.innerElements[s]);
                                    this.selector.innerHTML = "", this.selector.appendChild(i), this.selector.removeAttribute("style")
                                }
                                t && t.call(this)
                            }
                        }], [{
                            key: "mergeSettings",
                            value: function(e) {
                                var t = {
                                        selector: ".siema",
                                        duration: 200,
                                        easing: "ease-out",
                                        perPage: 1,
                                        startIndex: 0,
                                        draggable: !0,
                                        threshold: 20,
                                        loop: !1,
                                        onInit: function() {},
                                        onChange: function() {}
                                    },
                                    i = e;
                                for (var s in i) t[s] = i[s];
                                return t
                            }
                        }, {
                            key: "webkitOrNot",
                            value: function() {
                                return "string" == typeof document.documentElement.style.transform ? "transform" : "WebkitTransform"
                            }
                        }]), e
                    }();
                t.default = o, e.exports = t.default
            }])
        });
        //]]>
    </script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href=""><img src="<?php echo base_url('assets/ecommerce/img/logo.png'); ?>" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
            <?php if ($username == '' && $level == '') { ?>
                <div class="header__top__right__auth">
                    <a href="<?php echo base_url('Main_Ctrl/login'); ?>"><i class="fa fa-user"></i> Login &nbsp;&nbsp;</a>
                </div> |
                <div class="header__top__right__auth">
                    <a href="<?php echo base_url('Main_Ctrl/register'); ?>">&nbsp;&nbsp;<i class="fa fa-user-plus"></i> Register</a>
                </div>
            <?php } else { ?>
                <div class="header__top__right__auth">
                    <a href="<?php echo base_url('Main_Ctrl'); ?>"><i class="fa fa-user"></i> <?= $username ?> &nbsp;&nbsp;</a>
                </div> |
                <div class="header__top__right__auth">
                    <a href="<?php echo base_url('Main_Ctrl/change_password'); ?>"><i class="fa fa-lock"></i> Password &nbsp;&nbsp;</a>
                </div> |
                <div class="header__top__right__auth">
                    <a href="<?php echo base_url('Main_Ctrl/logout'); ?>">&nbsp;&nbsp;<i class="fa fa-user"></i> Logout</a>
                </div>
            <?php } ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="<?php echo base_url('Main_Ctrl'); ?>">Beranda</a>
                <li><a href="<?php echo base_url('Main_Ctrl/about'); ?>">Tentang Kami</a>
                    <!-- <li><a href="<?php echo base_url('Main_Ctrl/keranjang'); ?>">Keranjang</a> -->
                <li><a href="<?php echo base_url('Main_Ctrl/history'); ?>">Riwayat</a>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-phone"></i> 08127682535</li>
                <li><i class="fa fa-envelope"></i> creativeaudio@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-phone"></i> 08127682535</li>
                                <li><i class="fa fa-envelope"></i> creativeaudiopku@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <?php if ($username == '' && $level == '') { ?>
                                <div class="header__top__right__auth">
                                    <a href="<?php echo base_url('Main_Ctrl/login'); ?>">&nbsp;&nbsp;<i class="fa fa-user"></i> Login &nbsp;&nbsp;</a>
                                </div> |
                                <div class="header__top__right__auth">
                                    <a href="<?php echo base_url('Main_Ctrl/register'); ?>">&nbsp;&nbsp;<i class="fa fa-user-plus"></i> Register &nbsp;&nbsp;</a>
                                </div>
                            <?php } else { ?>
                                <div class="header__top__right__auth">
                                    <a href="<?php echo base_url('Main_Ctrl'); ?>">&nbsp;&nbsp;<i class="fa fa-user"></i> <?= $username ?> &nbsp;&nbsp;</a>
                                </div> |
                                <div class="header__top__right__auth">
                                    <a href="<?php echo base_url('Main_Ctrl/change_password'); ?>">&nbsp;&nbsp;<i class="fa fa-lock"></i> Password &nbsp;&nbsp;</a>
                                </div> |
                                <div class="header__top__right__auth">
                                    <a href="<?php echo base_url('Main_Ctrl/logout'); ?>">&nbsp;&nbsp;<i class="fa fa-user"></i> Logout</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="#"><img src="<?php echo base_url('assets/ecommerce/img/logo.png'); ?>" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="<?php echo base_url('Main_Ctrl'); ?>">Beranda</a>
                            <li><a href="<?php echo base_url('Main_Ctrl/produk'); ?>">Produk</a>
                            <li><a href="<?php echo base_url('Main_Ctrl/about'); ?>">Tentang Kami</a>
                                <!-- <li><a href="<?php echo base_url('Main_Ctrl/keranjang'); ?>">Keranjang</a> -->
                                <!-- <li><a href="<?php echo base_url('Transaksi_Ctrl/listKomentar'); ?>">Product Review</a> -->
                            <li><a href="<?php echo base_url('Main_Ctrl/history'); ?>">Riwayat Belanja</a>
                                <!-- <li><a href="<?php echo base_url('Main_Ctrl/history'); ?>">Transaksi Anda</a> -->

                        </ul>

                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li>Keranjang <a href="<?php echo base_url('Main_Ctrl/keranjang'); ?>"> <i class="fa fa-shopping-bag"></i> <span>
                                        <?php
                                        if ($kode != '') {
                                            $query = $this->db->query('SELECT * FROM tbl_transaksi WHERE aktif="0" AND id_user="' . $kode . '"');
                                            echo $query->num_rows();
                                        }
                                        ?>
                                    </span> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <!-- <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories" id="kategori">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori Produk</span>
                        </div>
                        <ul>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Alarm'); ?>">Alarm</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Audio'); ?>">Audio</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Kaca Film'); ?>">Kaca Film</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Klakson'); ?>">Klakson</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Sarung_Jok'); ?>">Sarung Jok</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Sarung_Stir'); ?>">Sarung Stir</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/TV'); ?>">TV</a></li>
                            <li><a href="<?php echo base_url('Main_Ctrl/kategori_produk/Wiper'); ?>">Wiper</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form method="POST" action="<?php echo base_url('Main_Ctrl/pencarian'); ?>">
                                <div class="hero__search__categories">
                                    Pencarian
                                </div>
                                <input type="text" name="cari" placeholder="Apa yang kamu butuhkan?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>
                    <div class="hero__item set-bg" id="banner" data-setbg="<?php echo base_url('assets/ecommerce/img/Banner1.jpg'); ?>">
                        <div class="hero__text">
                            <span></span>
                            <h2><br /></h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
    <!-- Hero Section End -->