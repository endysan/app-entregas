var code = '55FEE4011CCA4DA08F5C3C1C5A414FCA';
var isOpenLightbox = PagSeguroLightbox({
    code: 'code'
}, {
    success : function(transactionCode) {
        alert("success - " + transactionCode);
    },
    abort : function() {
        alert("abort");
    }
});
// Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox
if (!isOpenLightbox){
    location.href="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;
}