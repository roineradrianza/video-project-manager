/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: `${app_container}`,
  data: {
    selectedItem: 1,
    drawer: true,
    barAlert: false,
    barTimeout: 1000,
    barMessage: '',
    barType: '',
    loading: false,
    modal: false,
    headers: [
      { text: 'Nombre completo', align: 'start', value: 'full_name' },
      { text: 'Tipo de usuario', value: 'user_type' },
      { text: 'Correo electrónico', value: 'email' },
      { text: 'Acciones', value: 'actions', align: 'center', sortable: false },
    ],
    users: new User(),
    user_types: ['administrador', 'miembro'],
    password: '',
    password_confirm: '',
  },

  computed: {
    formTitle() {
      return this.users.index === -1 ? 'Registrar usuario' : 'Editar usuario'
    },
  },

  created() {
    this.users.load()
  },

  methods: {

  }
});