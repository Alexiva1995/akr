var v_liquidation = new Vue({
    el: '#AKR',
    data: function(){
        return{
            selecAllComision: false,
            StatusProcess: '',
            Comisiones: []
        }
    },
    methods: {
        /**
         * Permite obtener la informacion de las comisiones de un usuario
         * @param {integer} iduser 
         */
         getDetail: function(iduser){
            let url = route('liquidation.show', iduser)
            this.selecAllComision = false
            axios.get(url).then((response) => {
                this.Comisiones = response.data
                $('#modalModal').modal('show')
            }).catch(function (error) {
                toastr.error("Ocurrio un problema con la solicitud", '¡Error!', { "progressBar": true });
            })
        },

        /**
         * Permite obtener la informacion de las comisiones de las liquidaciones
         * @param {integer} iduser 
         */
         getDetailComisionLiquidation: function(iduser){
            let url = route('liquidation.edit', iduser)
            this.selecAllComision = false
            axios.get(url).then((response) => {
                this.Comisiones = response.data
                $('#modalModal').modal('show')
            }).catch(function (error) {
                toastr.error("Ocurrio un problema con la solicitud", '¡Error!', { "progressBar": true });
            })
        },

        /**
         * Permite obtener la informacion de las comisiones de las -liquidaciones para aprobar o reversar
         * @param {integer} iduser
         * @param {string} status
         */
         getDetailComisionLiquidationStatus: function(iduser, status){
            this.StatusProcess = status
            let url = route('liquidation.edit', iduser)
            this.selecAllComision = false
            axios.get(url).then((response) => {
                this.Comisiones = response.data
                $('#modalModalAccion').modal('show')
            }).catch(function (error) {
                toastr.error("Ocurrio un problema con la solicitud", '¡Error!', { "progressBar": true });
            })
        }
    }
})