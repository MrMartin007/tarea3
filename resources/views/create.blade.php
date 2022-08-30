<form method="POST" v-on:submit.prevent="createDato">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Crear</h4>
                </div>
                <div class="modal-body">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="newName">

                    <label for="addres">Addres</label>
                    <input type="text" name="addres" class="form-control" v-model="newAddres">

                    <label for="phone_number">phone Number</label>
                    <input type="text" name="phone_number" class="form-control" v-model="newPhone_number">

                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>
