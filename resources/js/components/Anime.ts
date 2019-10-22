import {Vue, Component} from './vue'

@Component({
    props: {
        log: {
            type: Array,
            default: [],
            required: true
        }
    },
    template: `
    <div class='bg-dark text-danger text-xl text-center my-2 py-3'>
        <span>{{dialog[line] | capt}}</span>
    </div>`,
    mounted () {
        setInterval(() => {
            this.line = this.count % this.log.length
            this.count++
        }, 1000)
    }
})

export default class Anime extends Vue
{
    public log: Array<string>
    public count: number = 0
    public line: number = 0
    public dialog: Array<string> = this.log
}