   <!-- <script src="<?= $app['base_assets_url']; ?>js/bootstrap.min.js"></script>-->
     <script src="<?= $app['base_assets_url']; ?>js/bootstrap-select.js"></script>
      <script>
        window.scrollTo(0, 0);
        window.addEventListener('scroll', function(e) {
            // console.log(window.scrollY);
            if (window.scrollY > 100) {
                document.getElementsByClassName('header_outer')[0].classList.add("sticky");
            } else {
                document.getElementsByClassName('header_outer')[0].classList.remove("sticky");
            }
        })


        $('.custom_textarea').on("keyup", function(e) {
            var maxlength = 10000;

            this.style.height = "1px";
            if (parseInt(this.scrollHeight) <= 50) {
                console.log(this.scrollHeight);
                this.style.height = "50px";
            } else {
                this.style.height = (this.scrollHeight) + "px";
            }

        });



        $('.slide_toggle').click(function() {
            var check = $('.edit_side').hasClass("toggle")
            if (check) {
               /* console.log("a")*/
                $('.edit_side').removeClass("toggle")
            } else {
                $('.edit_side').addClass("toggle")
            }
        })
    </script>
              
    <?php include_once $this->getPart('/web/common/popUp.php'); ?>
