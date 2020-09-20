<template>
    <div id="app">
        <h1>Braiiny app</h1>
        <div id="nav">
            <router-link to="/admin/products">Products</router-link> |
            <router-link to="/admin/contacts">Contacts (not implemented)</router-link>
        </div>
        <router-view/>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                header_links: [],
                footer_links: [],
            }
        },
        computed : {
            isLoggedIn : function() {
                return this.$store.getters.isLoggedIn;
            }
        },
        methods: {
            logout: function () {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/user/login')
                    })
            },
            load_navigation() {
                let url = '/navigation/123';
                this.$http.get(url)
                    .then( resp => {
                        this.header_links = resp.data.links[0].children
                        //console.log(this.header_links)
                        this.footer_links = resp.data.links[1].children
                    })
                    .catch( err => {

                    })
                    .finally( () => {

                    });
            }

        },
        mounted() {
            this.load_navigation()
        }
    }
</script>


<style>
    /*
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }
     */
    #nav {
        padding: 30px;
    }

    #nav a {
        font-weight: bold;
        color: #2c3e50;
    }

    #nav a.router-link-exact-active {
        color: #42b983;
    }
</style>
