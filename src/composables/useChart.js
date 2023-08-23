import { useStore } from 'vuex'
import { onMounted, ref } from 'vue'


export default function useChart() {

    const store = useStore();
    // onBeforeMount(store.dispatch('getEarnings'))

    window.chartColors = {
        green: '#f45a2a', // rgba(117,193,129, 1)
        blue: '#5b99ea', // rgba(91,153,234, 1)
        gray: '#a9b5c9',
        text: '#252930',
        border: '#e7e9ed'
    };

    // /* Random number generator for demo purpose */
    // const randomDataPoint = function(){ return Math.round(Math.random()*100)};

    const Impressions = store.getters.getSellerAnalytics ? store.getters.getSellerAnalytics.analytics.reverse() : [];
    const barChartConfig = ref({
        type: 'bar',

        data: {
            labels: Impressions.map(week => week.day),
            datasets: [{
                label: 'Impressions',
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                borderWidth: 1,
                maxBarThickness: 16,

                data: Impressions.map(week => week.impressions)
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            legend: {
                position: 'bottom',
                align: 'end',
            },
            title: {
                display: true,
                text: 'Weekly Impressions'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                titleMarginBottom: 10,
                bodySpacing: 10,
                xPadding: 16,
                yPadding: 16,
                borderColor: window.chartColors.border,
                borderWidth: 1,
                backgroundColor: '#fff',
                bodyFontColor: window.chartColors.text,
                titleFontColor: window.chartColors.text,

            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        drawBorder: false,
                        color: window.chartColors.border,
                    },

                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        drawBorder: false,
                        color: window.chartColors.borders,
                    },


                }]
            }

        }
    });

    onMounted(() => {
        const barChart = document.getElementById('canvas-barchart').getContext('2d');
        window.myBar = new window.Chart(barChart, barChartConfig.value);
    })

}