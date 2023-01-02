export default {
    millisToMinutesAndSeconds: (millis: string) => {
        const minutes = Math.floor(Number(millis) / 60000)
        const seconds = Number(((Number(millis) % 60000) / 1000).toFixed(0))
        return minutes + ":" + (seconds < 10 ? '0' : '') + seconds
    },

    dateTimeToDate: (dateTime: Date) => {
        const year = dateTime.getFullYear()
        let month = String(dateTime.getMonth() + 1)
        let day = String(dateTime.getDate())

        month = month.length > 1 ? month : `0${month}`
        day = day.length > 1 ? day : `0${day}`

        const date = `${year}-${month}-${day}`

        return date
    }
}