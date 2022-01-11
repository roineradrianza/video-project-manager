class User {
    constructor() {
        this.alert = true,
        this.alert_type = '',
        this.alert_message = '',
        this.snackbar = false,
        this.snackbar_timeout = 3000,
        this.snackbar_text = '',
        this.dialog = false,
        this.delete_dialog = false,
        this.loading = false,
        this.form = true,
        this.user = {
            first_name: '',
            last_name: '',
            email: '',
            user_type: 'administrador',
            password: '',
        },
        this.default = {
            first_name: '',
            last_name: '',
            email: '',
            user_type: 'administrador',
            password: '',
        },
        this.index = -1,
        this.items = []
    }

    reset() {
        this.loading = false
        this.alert = false
        this.user = Object.assign({}, this.default)
        this.index = -1
    }

    load() {
        var app = this
        var url = api_url + 'members/get/'
        app.loading = true
        Http.get(url).then(res => {
            if (res.length > 0) {
                res.forEach(user => {
                    user.full_name = `${user.first_name} ${user.last_name}`
                });
                app.items = res
            }
            app.loading = false
        }, err => {
            app.response({type: 'error'})
        })
    }

    save() {
        var app = this
        app.active = false
        app.loading = true
        if (app.index >= 0) {
            var url = api_url + 'members/update'
            Http.put(url, app.user).then(res => {
                app.response(res.status, res.message)
                if(res.status == 'success') {
                    app.load()
                }
                app.dialog = false
                app.reset()
            }, err => {
                app.response('error')
            })
        }
        else {
            var url = api_url + 'members/create'
            Http.post(url, app.user).then(res => {
                app.response(res.status, res.message)
                if(res.status == 'success') {
                    app.user.user_id = res.data.id
                    app.user.full_name = `${app.user.first_name} ${app.user.last_name}`
                    app.items.push(app.user)
                }
                app.dialog = false
                app.reset()
            }, err => {
                app.response('error')
            })
        }
    }

    editItem(item) {
        this.index = this.items.indexOf(item)
        this.user = Object.assign({}, item)
        this.dialog = true
    }

    deleteItem(item) {
        this.index = this.items.indexOf(item)
        this.user = Object.assign({}, item)
        this.delete_dialog = true
    }

    delete() {
        var app = this
        app.active = false
        app.loading = true
        var url = api_url + 'members/delete'
        Http.delete(url, app.user).then(res => {
            app.response(res.status, res.message)
            if(res.status == 'success') {
                app.load()
                app.delete_dialog = false
                app.reset()
            }
        }, err => {
            app.response('error')
        })
    }

    response(type = '', message = '') {
        type == 'error' ? message == '' ? 'Error inesperado, intente de nuevo' : message : message
        this.loading = false
        this.alert = true
        this.alert_type = type
        this.snackbar = true,
        this.snackbar_timeout = 3000,
        this.alert_message, this.snackbar_text = message
    }

    editDialog(item) {
        this.user = Object.assign({}, item)
        this.index = this.items.indexOf(item)
        this.dialog = true
    }

    deleteDialog(item) {
        this.user = Object.assign({}, item)
        this.index = this.items.indexOf(item)
        this.delete_dialog = true
    }

}