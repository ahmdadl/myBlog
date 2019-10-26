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

    public updatePost (){
        this.saving = true
        Axios.put('/posts/' + this.$props.postData.slug, {
            title: this.title,
            body: this.body
        })
            .then(res => {
                console.log(res)
                if (res.status === 200 && res.data.img) {
                    this.$root.$data.post.title = res.data.title
                    this.$root.$data.post.body = res.data.body
                    this.$bvModal.hide('post-edit')
                }
            })
            .catch(err => {
                console.log(err.response || err)
            })
            .finally(() => {this.saving = false})
    }
}