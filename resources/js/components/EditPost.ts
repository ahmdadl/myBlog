import {Vue, Component} from './vue'
import Axios from 'axios';

@Component({
    props: {
        id: {
            type: String,
            required: true
        },
        postData: {
            type: Object,
            required: true
        },
        isPost: {
            required: false
        },
        postIndx: {
            type: Number,
            required: false
        }
    },
    template: require('./edit-post.html')
})
export default class EditPost extends Vue
{
    public title: string = ''
    public body: string = ''
    public saving = false

    mounted () {
        this.title = this.$props.postData.title
        this.body = this.$props.postData.body
    }

    public get modalId () : string {
        return this.$props.id
    } 

    public updatePost (){
        this.saving = true

        Axios.post('/json/posts/' + this.$props.postData.slug + '/edit', {
            title: this.title,
            body: this.body
        })
            .then(res => {
                // console.log(res)
                if (res.status === 200 && res.data.img) {
                    let p = {
                        title: '',
                        body: ''
                    }

                    if (!this.$props.isPost) {
                        p = this.$root.$data.posts[this.$props.postIndx]
                    } else {
                        p = this.$root.$data.post
                    }
                    p.title = res.data.title
                    p.body = res.data.body
                    this.$bvModal.hide(this.modalId)
                    this.title = this.body = ''
                }
            })
            .catch(err => {
                // console.log(err.response || err)
            })
            .finally(() => {this.saving = false})
    }
}