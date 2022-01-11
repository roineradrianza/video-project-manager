<!-- START AFTER THIS-->
<v-main>
    <!-- Provides the application the proper gutter -->
    <v-container fluid white>
        <v-row>
            <v-col cols="12" md="9" lg="10" class="pt-16 pl-md-8">
            <?=new Controller\Template('components/snackbar',
                [
                    'snackbar' => 'users.snackbar',
                    'snackbar_timeout' => 'users.snackbar_timeout',
                    'snackbar_text' => 'users.snackbar_text',
                ]
            )
            ?>
                <h2>Miembros</h2>
                <v-row class="mt-6">
                    <v-col cols="12">
                        <v-data-table :headers="headers" :items="users.items" sort-by="full_name" class="elevation-1" :loading="users.loading">
                            <template #top>
                                <v-toolbar flat>
                                    <v-spacer></v-spacer>
                                    <?=new Controller\Template('admin/partials/users/dialog')?>
                                    <?=new Controller\Template('admin/partials/users/delete_dialog')?>
                                </v-toolbar>
                            </template>
                            <template #item.actions="{ item }">
                                <v-icon md @click="users.editItem(item)" color="#00BFA5">
                                    mdi-pencil
                                </v-icon>
                                <v-icon md @click="users.deleteItem(item)" color="#F44336">
                                    mdi-delete
                                </v-icon>
                            </template>
                            <template #no-data>
                                No se encontraron registros
                            </template>
                        </v-data-table>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</v-main>