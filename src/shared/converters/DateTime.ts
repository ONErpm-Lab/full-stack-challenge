export default {
    millisToMinutesAndSeconds: (millis: string) => {
        const minutes = Math.floor(Number(millis) / 60000)
        const seconds = Number(((Number(millis) % 60000) / 1000).toFixed(0))
        return minutes + ":" + (seconds < 10 ? '0' : '') + seconds
    },

    dateTimeToDate: (dateTime: Date) => {
        const year = dateTime.getFullYear()
        const month = dateTime.getMonth() + 1
        const day = dateTime.getDate()

        const date = `${year}-${month}-${day}`

        return date
    }
}