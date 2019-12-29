import Vue, { VNode } from "vue"
import Component from "vue-class-component"
import * as Compo from "./components/index"
import BootstrapVue from "bootstrap-vue"
import Axios from 'axios';

Axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
// @ts-ignore
Axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementById('csrf-token').value

Vue.config.productionTip = false
Vue.use(BootstrapVue)

Vue.filter("capt", (str: string) => {
    if (!str) return ""
    let output: Array<string> = []
    str.split(" ").forEach(word => {
        output.push(word[0].toUpperCase() + word.slice(1))
    })

    return output.join(" ")
})

Vue.filter("uppercase", (str: string) => {
    return str.toUpperCase()
})

/**
 * Register components
 */
Vue.component("stable", Compo.Table)
Vue.component("anime", Compo.Anime)
Vue.component("post-modal", Compo.PostModal)
Vue.component("edit-post", Compo.EditPost)
Vue.component('paginator', Compo.Paginator)

const Data = {
    title: "shopping list in here",
    items: ["asd", "eerd", "trtr"],
    limit: 10,
    memeText: "",
    showSolution: "",
    someOf: false,
    printer: [],
    gender: [],
    dialog: [
        "Hi",
        "Some time Please",
        "We are finishing stuff",
        "for you",
        "please...",
        "be patient",
        "will be over soon"
    ],
    fruite: [
        "They call me fruit.",
        "They call me fish.",
        "They call me insect.",
        "But actually I'm not one of those",
        "I`m a Dragon",
        "Fire Breather"
    ],
    refre: "some",
    imageSrc: false,
    imgs: [1, 2, 3, 4, 5],
    posts: null,
    post: null,
    tasks: [],
    updatingTask: false,
    newTask: "",
    taskBodyError: null,
    newTaskError: false,
    taskSaving: null,
    newComment: "",
    comErr: null,
    commentSaving: null,
    commentdeleting: null,
    postDeleteing: null,
    postIndx: null,
    paginate: null
}

const Comput = {
    isNighty: () => {
        return new Date().getHours() < 21
    },
    longText: function() {
        return this.memeText.length >= 3
    },
    // this.$on()
}

const Funct = {
    superMe() {
        // console.log(this.$el)
    },
    checkTask(postSlug: string, taskId: number, taskIndex: number): void {
        let loader = this.$refs["spinner" + taskId][0]
        const TaskDone = !this.$refs[taskId][0].checked

        // remove d-none from loader classes
        loader.classList = []

        Axios.put("/api/posts/" + postSlug + "/tasks/" + taskId, {
            done: TaskDone
        })
            .then(res => {
                // console.log(res)
                if (res.data.done === TaskDone && res.status === 200) {
                    this.post.tasks[taskIndex].done = TaskDone
                }
            })
            // .catch(err => console.log(err))
            .finally(() => {
                // hide loader
                loader.classList.add("d-none")
            })
    },
    saveTask(postSlug: string): void {
        this.taskBodyError = this.newTaskError = null
        this.taskSaving = true

        if (this.newTask.length < 5 || this.newTask.length > 70) {
            this.newTaskError = true
            // return
        }

        Axios.post("/posts/" + postSlug + "/tasks", {
            body: this.newTask
        })
            .then(res => {
                // console.log(res)

                if (res.status === 201) {
                    this.post.tasks.push(res.data)
                }
            })
            .catch(err => {
                // console.log(err)
                if (err.response) {
                    this.taskBodyError =
                        err.response.data.errors.body[0] ||
                        err.response.data.message
                }
            })
            .finally(() => (this.taskSaving = null))
    },
    addComment(postSlug: string): void {
        this.commErr = null
        this.commentSaving = true

        if (this.newComment.length < 25 || this.newComment.length > 350) {
            this.comErr = ""
            this.commentSaving = false
            // return
        }

        Axios.post("/posts/" + postSlug + "/comments", {
            body: this.newComment
        })
            .then(res => {
                // console.log(res)
                if (res.status === 201) {
                    this.newComment = ""
                    this.post.comments.unshift(res.data)
                    setTimeout(() => {
                        this.$refs["com" + res.data.id][0].classList.value +=
                            " buffer"
                    }, 100)
                }
            })
            .catch(err => {
                // console.log(err.response || err)

                if (err.response) {
                    this.comErr =
                        err.response.data.errors.body[0] ||
                        err.response.data.message
                }
            })
            .finally(() => {
                this.commentSaving = false
            })
    },
    deleteComment(postSlug: string, cId: number, index: number) {
        // console.log(this.$refs['co' + cId])
        const loader = this.$refs["co" + cId][0]
        loader.classList = []

        Axios.delete("/posts/" + postSlug + "/comments/" + cId)
            .then(res => {
                // console.log(res)
                if (res.status === 200 && res.data === "deleted") {
                    // console.log(this.post.comments[index])
                    this.post.comments.splice(1, index)
                }
            })
            .catch(err => {
                // console.log(err.response || err)
            })
            .finally(() => {
                loader.classList = ["d-none"]
            })
    },
    deletePost(postSlug: string, isPostPage: boolean, postIndx: number = 0) {
        // console.log(isPostPage)
        const loader = this.$refs['delPost' + postIndx][0]
        loader.classList.remove('d-none')

        Axios.delete("/posts/" + postSlug)
            .then(res => {
                // console.log(res)

                if (res.status === 200 && res.data.deleted) {
                    if (isPostPage) {
                        location.href = "/api/posts"
                    } else {
                        this.posts.splice(postIndx, 1)
                    }
                }
            })
            .catch(err => {
                // console.log(err.response || err)
            })
            .finally(() => {
                loader.classList.add('d-none')
            })
    },
    loadPosts(pageArg: number | string, objectToSet: string) {
        // show loading spinner
        this.posts = null
        
        let page = "?page=" + pageArg

        // check if request for one post it`s slug
        if (typeof pageArg === 'string') {
            page = "/" + pageArg
        }

        Axios.get("/json/posts" + page)
            .then(res => {
                // console.log(res.data)

                // check if pagination data provided
                if (res.data.current_page) {
                    this.paginate = {
                        current: res.data.current_page,
                        from: res.data.from,
                        to: res.data.last_page
                    }
                }
                
                // set proper data holder with response data
                this.$data[objectToSet] = res.data.data
            })
            .catch(err => console.error(err))
    }
}

const App = new Vue({
    el: "#app",
    data: Data,
    computed: Comput,
    methods: Funct,
    mounted() {
        /**
         * download data based on url
         */
        const Path = document.location.pathname
        if (Path === "/api/posts") {
            // split href into two to check if page number available
            let query = document.location.href.split('?')

            // if ?page exists in href
            if (query.length === 2) {
                // extract page number from url and load posts from 
                // this page
                this.loadPosts(parseInt(query[1].split('=')[1]), 'posts')
                return;
            }
            
            // return page one posts
            this.loadPosts(1, 'posts')
        } else {
            const PostSlug = Path.replace("/api/posts/", "")
            document.title = PostSlug
            this.loadPosts(PostSlug, 'post')
        }
    }
})
