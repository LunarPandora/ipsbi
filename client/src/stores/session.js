import { ref, onMounted } from 'vue'
import { defineStore } from 'pinia'

export const useSessionStore = defineStore('session', () => {
    const isAuthenticated = ref(false)
    const session = ref({
        id: '-',
        email: '-',
        foto_profil: '-',
        role: 'guest',
        username: 'guest'
    })

    // ===================================================================

    function refreshSession(){
        if(localStorage.getItem('isAuthenticated') != null){
            isAuthenticated.value = JSON.parse(localStorage.getItem('isAuthenticated'))
        }
    
        if(localStorage.getItem('user_session_ipsbi') != null){
            session.value = JSON.parse(localStorage.getItem('user_session_ipsbi'))
        }
    }

    // ===================================================================


    function resetSession(){
        session.value = {
            id: '-',
            email: '-',
            foto_profil: '-',
            role: 'guest',
            username: 'guest'
        }
    }

    function registerSession(user){
        session.value = user
    }

    function authenticate(){
        isAuthenticated.value = true
        localStorage.setItem('isAuthenticated', JSON.stringify(isAuthenticated.value))

        localStorage.setItem('user_session_ipsbi', JSON.stringify(session.value))
    }

    function inauthenticate(){
        isAuthenticated.value = false
        localStorage.setItem('isAuthenticated', JSON.stringify(isAuthenticated.value))

        resetSession()
        localStorage.setItem('user_session_ipsbi', JSON.stringify(session.value))
    }

    return { isAuthenticated, session, authenticate, inauthenticate, registerSession, resetSession, refreshSession }
})