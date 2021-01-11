let more = document.getElementsByName('more');
more.forEach(
    function (el) {

        el.onclick = function (event) {
            event.preventDefault();
            let pId = this.id;
            // SHOW PRODUCT IN MODAL 
            document.getElementById('popup-page').style.display = "block";
            // CLOSING MODAL 
            _('btn-popup-close').onclick = function () {
                _('popup-page').style.display = "none";

            }
            // END CLOSE MODAL 
            let pShow = _('popup-show');

            $.ajax({
                url: './control/action.php',
                method: 'POST',
                data:{
                    fetchSingleProduct: pId,
                },
                beforeSend: function () {
                    pShow.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                },
                success: function(data){
                    pShow.innerHTML = data;
                }
            })

        }
    }
)