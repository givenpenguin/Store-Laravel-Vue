import './bootstrap'
import { createApp } from 'vue'
import { createStore } from 'vuex'
import router from './router.js'
import App from './components/App.vue'

const store = createStore({
    state () {
        return {
            isDrawerOpen: false,
            isSidebarOpen: false,
            counter: 0,
        }
    },
    mutations: {
        toggleDrawer (state, newState) {
            state.isDrawerOpen = newState.isDrawerOpen
        },
        toggleSidebar (state, newState) {
            state.isSidebarOpen = newState.isSidebarOpen
        },
        counterValue (state, value) {
            state.counter = value.counter
        },
    }
})

const app= createApp({})

app.component('app', App)
app.use(router)
app.use(store)
app.mount('#app')
