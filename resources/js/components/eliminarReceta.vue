<template>
  <input
    type="submit"
    class="btn btn-danger d-block w-100 mb-2"
    value="Eliminar ×"
    v-on:click="eliminarReceta"
  />
</template>

<script>
export default {
  props: ["recetaId"],
  methods: {
    eliminarReceta() {
      this.$swal({
        title: "¿Deseas eliminar la receta?",
        text: "Una vez eliminada, no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
      }).then((result) => {
        if (result.isConfirmed) {
          // tenemos que pasar un objeto con el id para la ruta que hallamos definido en el web
          const params = {
            id: this.recetaId,
          };

          // enviamos la peticion al servidor con axios
          axios
            .post(`/recetas/${this.recetaId}`, { params, _method: "delete" })
            .then((respuesta) => {
              this.$swal({
                title: "Receta eliminada",
                text: "se eliminó la receta",
                icon: "success",
              });

              // eliminar receta del DOM
              this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            })
            .catch((error) => {
              console.log(error);
            });
          /*  this.$swal({
             title: 'Receta eliminada',
             text: 'se eliminó la receta',
             icon: 'success'
         }); */
        }
      });
    },
  },
};
</script>