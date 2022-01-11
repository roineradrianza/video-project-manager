class Project {
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
            this.project = {
                name: ''
            },
            this.default = {
                name: ''
            },
            this.index = -1,
            this.items = []
    }

    reset() {
        this.loading = false
        this.alert = false
        this.project = Object.assign({}, this.default)
        this.index = -1
    }

    load() {
        let app = this
        let url = api_url + 'projects/get/'
        app.loading = true
        app.items = []
        Http.get(url).then(res => {
            if (res.length > 0) {
                app.items = res
            }
            app.loading = false
        }, err => {
            app.response({ type: 'error' })
        })
    }

    save() {
        let app = this
        app.loading = true
        if (app.index >= 0) {
            let url = api_url + 'projects/update'
            Http.put(url, app.project).then(res => {
                app.response(res.status, res.message)
                if (res.status == 'success') {
                    app.load()
                }
                app.dialog = false
                app.reset()
            }, err => {
                app.response('error')
            })
        }
        else {
            let url = api_url + 'projects/create'
            Http.post(url, app.project).then(res => {
                app.response(res.status, res.message)
                if (res.status == 'success') {
                    app.project.project_id = res.data.project_id
                    app.items.push(app.project)
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
        this.project = Object.assign({}, item)
        this.dialog = true
    }

    deleteItem(item) {
        this.index = this.items.indexOf(item)
        this.project = Object.assign({}, item)
        this.delete_dialog = true
    }

    delete() {
        let app = this
        app.loading = true
        let url = api_url + 'projects/delete/' + app.project.project_id
        Http.delete(url).then(res => {
            app.response(res.status, res.message)
            if (res.status == 'success') {
                app.load()
                app.delete_dialog = false
            }
            app.reset()
        }, err => {
            app.response('error')
        })
    }

    response(type = '', message = '') {
        type == 'error' ? message == '' ? 'Error inesperado, intente de nuevo' : message : message
        this.loading = false
        this.alert = true
        this.alert_type = type
        this.snackbar = true
        this.snackbar_timeout = 3000,
            this.alert_message, this.snackbar_text = message
    }

    editDialog(item) {
        this.project = Object.assign({}, item)
        this.index = this.items.indexOf(item)
        this.dialog = true
    }

    deleteDialog(item) {
        this.project = Object.assign({}, item)
        this.index = this.items.indexOf(item)
        this.delete_dialog = true
    }

}