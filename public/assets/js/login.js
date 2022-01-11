
/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#app-container',
  data: {
    redirect_url: url_params.get('redirect_url'),
    tab: null,
    nav_tab: null,
    dialog: false,
    loading: false,
    reset_loading: false,
    alert: false,
    alert_type: false,
    alert_message: '',
    email: '',
    email_reset: '',
    password: '',
  },

  computed: {
  },

  created() {
  },

  mounted() {
  },

  methods: {

    signIn() {
      var app = this
      app.loading = true
      app.alert = false
      var url = api_url + 'members/sign-in'
      var user = { 'email': app.email, 'password': app.password }
      app.$http.post(url, user).then(res => {
        app.alert = true
        app.alert_message = res.body.message
        app.alert_type = res.body.status
        if (res.body.status == 'success') {
          if (app.redirect_url != null) {
            window.location = app.redirect_url
          }
          else {
            window.location = res.body.data
          }
        }
      }, err => {
        app.loading = false
        app.alert = true
        app.alert_message = 'A apărut o eroare neașteptată, vă rugăm să încercați din nou.'
        app.alert_type = 'error'
      })
      app.loading = false
    },

    resetPassword() {
      var url = api_url + 'password/request-reset'
      var app = this
      var email = app.email_reset
      app.reset_loading = true
      app.alert = false
      app.$http.post(url, { email: email }).then(res => {
        app.reset_loading = false
        app.alert_message = res.body.message
        app.alert_type = res.body.status
        app.alert = true
        app.dialog = false
      }, err => {
        app.reset_loading = false

      })
    },

  }

});