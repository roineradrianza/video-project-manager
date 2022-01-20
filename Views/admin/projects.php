<v-main>
    <v-container fluid white>
        <v-row>
            <v-col cols="12" md="9" lg="10" class="pt-16 pl-md-8">
                <?=new Controller\Template('components/snackbar',
                    [
                        'snackbar' => 'projects.snackbar',
                        'snackbar_timeout' => 'projects.snackbar_timeout',
                        'snackbar_text' => 'projects.snackbar_text'
                    ]
                )
                ?>
                <?=new Controller\Template('components/snackbar',
                    [
                        'snackbar' => 'projects.video.snackbar',
                        'snackbar_timeout' => 'projects.video.snackbar_timeout',
                        'snackbar_text' => 'projects.video.snackbar_text'
                    ]
                )
                ?>
                <h2>Proyectos</h2>
                <v-row class="mt-6">
                    <v-col cols="12">
                        <v-data-table :headers="headers" :items="projects.items" sort-by="name" class="elevation-1">
                            <template #top>
                                <v-toolbar flat>
                                    <v-spacer></v-spacer>
                                    <?=new Controller\Template('admin/partials/projects/dialog')?>
                                    <?=new Controller\Template('admin/partials/projects/show_dialog')?>
                                    <?=new Controller\Template('admin/partials/projects/delete_dialog')?>
                                    <?=new Controller\Template('admin/partials/video/delete_dialog')?>
                                    <?=new Controller\Template('admin/partials/video/edit_dialog')?>
                                </v-toolbar>
                            </template>
                            <template #item.actions="{ item }">
                                <v-icon md @click="projects.showItem(item)" color="primary">
                                    mdi-eye
                                </v-icon>
                                <v-icon md @click="projects.editItem(item)" color="#00BFA5">
                                    mdi-pencil
                                </v-icon>
                                <v-icon md @click="projects.deleteItem(item)" color="#F44336">
                                    mdi-delete
                                </v-icon>
                            </template>
                            <template #no-data>
                                No se ha encontrado registros
                            </template>
                        </v-data-table>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</v-main>