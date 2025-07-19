document.addEventListener("DOMContentLoaded", function() {
    const cnpjCpfInput = document.getElementById("cpfCnpj");
    const phoneInput = document.getElementById("mobilePhone");
    const cepInput = document.getElementById("postalCode");

    cnpjCpfInput.addEventListener("input", function() {
        let value = this.value.replace(/\D/g, '');
        const isCnpj = value.length > 11;

        value = isCnpj ?
            value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, '$1.$2.$3/$4-$5') :
            value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, '$1.$2.$3-$4');

        this.value = value;
    });

    phoneInput.addEventListener("input", function() {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
        this.value = value;
    });

    cepInput.addEventListener("input", function() {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/^(\d{5})(\d{3}).*/, '$1-$2');
        this.value = value;
    });
});
