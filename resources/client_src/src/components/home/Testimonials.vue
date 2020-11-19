<template>
    <section class="testimonial-holder">
        <v-carousel height="100%" cycle hide-delimiters show-arrows-on-hover>
            <v-carousel-item
                v-for="testimonial in testimonials"
                :key="testimonial.id"
                style="background-color: #0E1932; opacity: 0.9"
            >
                <v-row
                    style="height: 100%"
                    justify="center"
                    align-content="center"
                    no-gutters
                >
                    <div class="quotation-holder">
                        <v-img
                            src="../../assets/quotation-marks.png"
                            width="70"
                        ></v-img>
                    </div>

                    <v-card-text
                        class="testimonial-text"
                        v-text="testimonial.text"
                    >
                    </v-card-text>

                    <v-card-title class="pb-0" v-text="testimonial.username">
                    </v-card-title>

                    <v-card-text
                        class="text-center"
                        style="font-style: italic"
                        v-text="testimonial.userPosition"
                    ></v-card-text>
                </v-row>

                <v-card-text>
                    <p></p>
                </v-card-text>
            </v-carousel-item>
        </v-carousel>
    </section>
</template>

<script>
export default {
    name: "Testimonials",

    data: () => ({
        testimonials: [
            {
                id: 1,
                text: `Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Consectetur nobis ut odit velit obcaecati,
                        similique esse dolor repellat distinctio id ratione
                        ullam ab dignissimos, rem, enim illum. Natus, tempora
                        alias? Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Consectetur nobis ut odit velit
                        obcaecati, similique esse dolor repellat distinctio id
                        ratione ullam ab dignissimos, rem, enim illum. Natus,
                        tempora alias?`,
                username: "Monika Ghurde",
                userPosition: "UK User Only"
            },
            {
                id: 2,
                text: `Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Consectetur nobis ut odit velit obcaecati,
                        similique esse dolor repellat distinctio id ratione
                        ullam ab dignissimos, rem, enim illum. Natus, tempora
                        alias? Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Consectetur nobis ut odit velit
                        obcaecati, similique esse dolor repellat distinctio id
                        ratione ullam ab dignissimos, rem, enim illum. Natus,
                        tempora alias?`,
                username: "Augustine",
                userPosition: "Finance Manager"
            },
            {
                id: 3,
                text: `Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Consectetur nobis ut odit velit obcaecati,
                        similique esse dolor repellat distinctio id ratione
                        ullam ab dignissimos, rem, enim illum. Natus, tempora
                        alias? Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Consectetur nobis ut odit velit
                        obcaecati, similique esse dolor repellat distinctio id
                        ratione ullam ab dignissimos, rem, enim illum. Natus,
                        tempora alias?`,
                username: "Stephnie MacMohan",
                userPosition: "Iphone Developer"
            }
        ]
    })
};
</script>

<style scoped>
.testimonial-holder {
    position: relative;
    height: 475px;
    background: url(../../assets/office.jpg);
}

.quotation-holder {
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 30px 25px;
    border-radius: 50%;
}

.testimonial-text {
    margin-top: 50px;
    margin-bottom: 20px;
    padding: 0 150px;
    font-weight: 300;
    letter-spacing: 1px;
}
</style>
