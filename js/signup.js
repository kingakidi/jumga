
let sf = _('signup')
let se =  _('signup-error');
let fn = _('fullname');
let e = _('email');
let p = _('phone')
let g = _('gender')
let c = _('country')
let t = _('type')
let password = _('password')
let bs = _('btn-submit')
 iArray = [fn, e, p, password]
 sArray = [t, c, g]

 iArray.forEach(
     function (el) {
         el.onblur = function () {
            if (el.value === "") {
                _(`${el.id}`).style.border = '1px solid red';
            }else{
               _(`${el.id}`).style.border = '';
            }
         }
     }
 );

 

 t.onchange = function (event) {
    if (this.value.trim() === 'merchant') {
        bs.value = 'Next'
    }else{
        bs.value = 'Signup'
    }
 }

sf.addEventListener('submit', function (event) {
    event.preventDefault();
    if (check(fn) && check(e) && check(p) && check(g) && check(c) && check(t)) {
    
        $.ajax({
            type: 'POST',
            url: './control/action.php',
            data: {
                fn: fn.value, 
                e: e.value, 
                p: p.value, 
                g: g.value,
                c: c.value,
                t: t.value,
                password: password.value,
                signup: '1'

            }, 
            beforeSend: function () {
                bs.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Loading' 
               bs.disabled = true;
            }, 
            success: function (data) {
                se.innerHTML = data;
                se.style.visibility = 'visible'
                bs.innerHTML = 'Signup' 
                bs.disabled = false;
            }
        })
    }else{
    //   SEND DATA TO DATABASE 
        se.innerHTML = '<span class="text-danger">All field required</span>';
        se.style.visibility = 'visible'
    }
    
})







