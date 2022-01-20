<v-dialog v-model="projects.show_dialog" max-width="1200px" @click:outside="projects.reset(); projects.show_dialog = false">
    <v-card>
        <v-toolbar elevation="0">
            <v-toolbar-title>{{ projects.project.name }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click="projects.reset(); projects.show_dialog = false">
                    <v-icon color="grey">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-divider></v-divider>

        <v-card-text>
            <?=new Controller\Template('admin/partials/video/edit')?>
            <?=new Controller\Template('admin/partials/video/loop')?>
        </v-card-text>

    </v-card>
</v-dialog>