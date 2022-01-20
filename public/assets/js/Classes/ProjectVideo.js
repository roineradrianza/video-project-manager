class ProjectVideo {
    constructor({ project_id = null }) {
        this.alert = true
        this.alert_type = ''
        this.alert_message = ''
        this.snackbar = false
        this.snackbar_timeout = 3000
        this.snackbar_text = ''
        this.dialog = false
        this.show_dialog = false
        this.loading = false
        this.edit_loading = false
        this.form = true
        this.endpoint = 'project-video'
        this.item = {
            project_video_id: null,
            src: '',
            name: '',
            video: new File([], ''),
            meta: {},
            project_id: project_id,
            created_at: '',
            updated_at: ''
        }
        this.default = {
            project_video_id: null,
            src: '',
            name: '',
            video: new File([], ''),
            meta: {},
            project_id: project_id,
            created_at: '',
            updated_at: ''
        }
        this.index = -1
        this.items = []
        this.video_players = []
        this.load()
    }

    reset() {
        this.loading = false
        this.alert = false
        this.item = Object.assign({}, this.default)
        this.index = -1
    }

    resetVideoPlayers() {
        Object.entries(videojs.players).forEach((key, i) => {
            videojs.players[key[0]].dispose()
        })
        this.video_players = []
    }

    load() {
        let app = this
        if (app.item.project_id == null) {
            return false
        }
        let url = api_url + `${app.endpoint}/get/${app.item.project_id}`
        app.loading = true
        app.items = []
        this.resetVideoPlayers()
        Http.get(url).then(res => {
            app.loading = false
            if (res.length > 0) {
                app.items = res
            }
        }, err => {
            app.response({ type: 'error' })
        }).then(() => {
            app.items.forEach(video => {
                app.renderVideoPlayer(video)
            });
        })
    }

    save() {
        let app = this
        app.edit_loading = true
        let data = new FormData
        Object.entries(app.item).forEach((key, i) => {
            key[1] = key[0] == 'meta' ? JSON.stringify(key[1]) : key[1]
            data.append(key[0], key[1])
        })
        if (app.index >= 0) {
            let url = api_url + `${app.endpoint}/update`
            Http.put(url, app.item).then(res => {
                app.response(res.status, res.message)
                if (res.status == 'success') {
                    app.load()
                }
                app.dialog = false
                app.edit_loading = false
                app.reset()
            }, err => {
                app.response('error')
            })
        }
        else {
            let url = api_url + `${app.endpoint}/create`
            Http.post(url, data).then(res => {
                app.response(res.status, res.message)
                if (res.status == 'success') {
                    app.item.project_video_id = res.data.project_video_id
                    app.item.src = res.data.meta.src
                    app.item.meta = res.data.meta.meta
                    app.items.push(app.item)
                }
                app.dialog = false
                app.edit_loading = false
                return app.item
            }, err => {
                app.response('error')
            }).then( res => {
                if (res.hasOwnProperty('project_video_id')) {
                    app.renderVideoPlayer(res)
                }
            })
        }
    }

    renderVideoPlayer(video) {
        let sources = [
            {
                type: "video/mp4",
                src: video.meta.video_url_1080p,
                label: '1080p',
            },

            {
                type: "video/mp4",
                src: video.meta.video_url_720p,
                label: '720p',
                selected: true,
            },

            {
                type: "video/mp4",
                src: video.meta.video_url_480p,
                label: '480p',
            },

            {
                type: "video/mp4",
                src: video.meta.video_url_360p,
                label: '360p',
            },

            {
                type: "video/mp4",
                src: video.meta.video_url_240p,
                label: '240p',
            },

        ]
        let player = videojs('video_' + video.project_video_id, {
            fluid: true,
            language: "es",
            sources: sources,
            controlBar: {
                children: [
                    "playToggle",
                    "progressControl",
                    "volumePanel" 
                ],
            }
        })
        player.controlBar.addChild('QualitySelector')
        let panorama = player.panorama({
            clickAndDrag: true,
            PanoramaThumbnail: true, //enable panorama thumbnail
            KeyboardControl: true,
            clickToToggle: true,
            VREnable: false,
            NoticeMessage: '',
            Notice: {
                Enable: false,
            }
        });
        this.video_players.push(player)
    }

    showItem(item) {
        this.index = this.items.indexOf(item)
        this.item = Object.assign({}, item)
        this.show_dialog = true
    }

    editItem(item) {
        this.index = this.items.indexOf(item)
        this.item = Object.assign({}, item)
        this.dialog = true
    }

    deleteItem(item) {
        this.index = this.items.indexOf(item)
        this.item = Object.assign({}, item)
        this.delete_dialog = true
    }

    delete() {
        let app = this
        let url = api_url + `${app.endpoint}/delete/${app.item.project_video_id}`
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

}