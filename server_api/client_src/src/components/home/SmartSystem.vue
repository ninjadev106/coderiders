<template>
    <section style="margin: 80px 0">
        <v-container>
            <v-row class="smart-systems-holder" justify="end" align="center">
                <v-col cols="6">
                    <v-card-title class="display-3 primary--text main-title">
                        Smart System
                    </v-card-title>

                    <p class="px-5 mt-3">
                        lorem Ipsum is simply dummy text of the phasellus
                        porttitor, nisi at fermentum consectetur
                    </p>

                    <v-card-actions>
                        <v-btn
                            color="primary"
                            large
                            width="120"
                            class="ml-3"
                            tile
                            >shop now</v-btn
                        >
                    </v-card-actions>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
export default {
    name: "SmartSystem",

    data: () => ({})
};
</script>

<style scoped>
.main-title {
    font-weight: 900;
    word-break: normal;
}

.smart-systems-holder {
    height: 400px;
    background: url(../../assets/smart-system.jpg);
    background-size: contain;
}
</style>
