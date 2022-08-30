<form method="POST" v-on:submit.prevent="updateDato(fillDato.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4>Editar</h4>
                </div>
                <div class="modal-body">
                    <label for="name">Actualizar Nombre</label>
                    <input type="text" name="name" class="form-control" v-model="fillDato.name">
                    <label for="addres">Actualizar Addres</label>
                    <input type="text" name="addres" class="form-control" v-model="fillDato.addres">
                    <label for="phone_number">Actualizar Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" v-model="fillDato.phone_number">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>
