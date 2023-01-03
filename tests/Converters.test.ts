import DateTime from "../src/shared/converters/DateTime"

describe('Tests if DateTime converters work - Right Scenario', () => {

    test('Tests if millisToMinutesAndSeconds is working and consistent', async () => {

        const time = DateTime.millisToMinutesAndSeconds('149538')

        expect(time).toBe('2:30')
    })

    test('Tests if dateTimeToDate is working and consistent', async () => {

        const date = DateTime.dateTimeToDate(new Date('2021-8-31'))

        expect(date).toBe('31/08/2021')
    })
})