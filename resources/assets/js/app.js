new Vue({
    el: '#crud',
    created: function() {
        this.getDatos();
    },
    data: {
        datos: [],
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        newName: '',
        newAddres: '',
        newPhone_number: '',
        fillDato: {'id': '', 'name': '', 'addres': '', 'phone_number': ''},
        errors: '',
        offset: 3,
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        getDatos: function(page) {
            var urlDatos = 'customers?page='+page;
            axios.get(urlDatos).then(response => {
                this.datos = response.data.customers.data,
                    this.pagination = response.data.pagination
            });
        },
        editDato: function(dato) {
            this.fillDato.id   = dato.id;
            this.fillDato.name = dato.name;
            this.fillDato.addres = dato.addres;
            this.fillDato.phone_number = dato.phone_number;
            $('#edit').modal('show');
        },
        updateDato: function(id) {
            var url = 'customers/' + id;
            axios.put(url, this.fillDato).then(response => {
                this.getDatos();
                this.fillDato = {'id': '', 'name': '', 'addres': '', 'phone_number': ''};
                this.errors	  = [];
                $('#edit').modal('hide');
                toastr.success('Tarea actualizada con éxito');
            }).catch(error => {
                this.errors = 'Corrija para poder editar con éxito'
            });
        },
        deleteDato: function(dato) {
            var url = 'customers/' + dato.id + dato.name + dato.addres + dato.phone_number;
            axios.delete(url).then(response => { //eliminamos
                this.getDatos(); //listamos
                toastr.success('Eliminado correctamente'); //mensaje
            });
        },

        createDato: function() {
            var url = 'customers';
            axios.post(url, {
                name: this.newName,
                addres: this.newAddres,
                phone_number: this.newPhone_number,
            }).then(response => {
                this.getDatos();
                this.newName = '';
                this.newAddres = '';
                this.newPhone_number = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Nueva tarea creada con éxito');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito'
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getDatos(page);
        }
    }
});
































