<v-row>
    <template v-if="projects.video.loading">
        <v-col cols="12">
            <v-row>
                <v-col cols="12" md="4" v-for="i, in 3" :key="i">
                    <v-skeleton-loader type="card"></v-skeleton-loader>
                </v-col>
            </v-row>
        </v-col>
    </template>
    <template v-else>
        <template v-if="projects.video.items.length <= 0">
            <v-col cols="12">
                <v-row justify="center">
                    <v-col cols="4">
                        <v-img src="/img/not-videos.svg"></v-img>
                    </v-col>
                    <v-col cols="12">
                        <h3 class="text-center">
                            No se ha encontrado videos registrados en este proyecto
                        </h3>
                    </v-col>
                </v-row>
            </v-col>
        </template>
        <template v-else>
            <template v-for="video, i in projects.video.items">
                <v-col cols="12" md="6">
                    <v-card>
                        <video :id="'video_' + video.project_video_id" class="video-js vjs-default-skin" width="100%"
                            controls>
                            <source :src="video.meta.video_url_1080p" type="video/mp4" label="1080P">
                            <source :src="video.meta.video_url_720p" type="video/mp4" label="720P" selected="true">
                            <source :src="video.meta.video_url_480p" type="video/mp4" label="480P">
                            <source :src="video.meta.video_url_360p" type="video/mp4" label="360P">
                            <source :src="video.meta.video_url_240p" type="video/mp4" label="240P">
                        </video>
                        <v-card-title class="py-0">
                            <span class="primary--text">{{ video.name }}
                            </span>
                        </v-card-title>

                        <v-card-actions class="justify-center">
                            <v-tooltip top>
                                <template #activator="{ on, attrs }">
                                    <v-btn color="#00BFA5" @click="projects.video.editItem(video)" v-bind="attrs"
                                        v-on="on" icon text>
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Editar nombre</span>
                            </v-tooltip>

                            <v-tooltip top>
                                <template #activator="{ on, attrs }">
                                    <v-btn color="primary" v-clipboard:copy="'<?= SITE_URL ?>' + video.src"
                                        v-bind="attrs" v-on="on" icon text>
                                        <v-icon>mdi-link</v-icon>
                                    </v-btn>
                                </template>
                                <span>Obtener vínculo</span>
                            </v-tooltip>

                            <v-tooltip top>
                                <template #activator="{ on, attrs }">
                                    <v-btn color="error" v-bind="attrs" v-on="on"
                                        @click="projects.video.deleteItem(video)" icon text>
                                        <v-icon>mdi-trash-can</v-icon>
                                    </v-btn>
                                </template>
                                <span>Borrar video</span>
                            </v-tooltip>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </template>
        </template>
    </template>
</v-row>