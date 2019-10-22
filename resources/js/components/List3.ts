import {Vue, Component} from './vue'

@Component({
    props: {
        title: {
            type: String,
            required: true
        }
    },
    template: `
    <ul>
        <li v-for='n in all'>{{n}} --> {{title}} --> {{rand}}</li>
    </ul>`
})
export default class List3 extends Vue
{
    public all: Array<number> = [1, 2, 3, 4, 5]
    // public rand: number = 1;

    public mounted() : void
    {
        console.log(this.$props)
    }

    public randomNum() : number
    {
        return Math.floor(Math.random() * 10)
    }

    get rand() : number
    {
        return this.randomNum()
    }

    get unCompleted() {
        return this.all.filter(x => x > 1)
    }
}