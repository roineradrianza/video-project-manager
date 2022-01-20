
VueClipboard.config.autoSetContainer = true // add this line
Vue.use(VueClipboard)
video
/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: `${app_container}`,
  data: {
    selectedItem: 0,
    drawer: true,
    barAlert: false,
    barTimeout: 1000,
    barMessage: '',
    barType: '',
    loading: false,
    dialog: false,
    dialogDelete: false,
    birthdateDialog: false,
    modal: false,
    headers: [
      { text: 'Nombre', align: 'start', value: 'name' },
      { text: 'Acciones', value: 'actions', align: 'center', sortable: false },
    ],
    projects: new Project,
    video_project: new ProjectVideo({project_id: null}),
  },

  computed: {
    formTitle() {
      return this.projects.index === -1 ? 'Añadir proyecto de inmobiliaria' : 'Editar inmobiliaria'
    },
  },

  created() {
    this.projects.load()
  },

  methods: {
  }
});