-- CreateTable
CREATE TABLE `Track` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `isrc` VARCHAR(191) NOT NULL,
    `thumb` VARCHAR(191) NOT NULL,
    `release_date` DATETIME(3) NOT NULL,
    `name` VARCHAR(191) NOT NULL,
    `artists` VARCHAR(191) NOT NULL,
    `duration` INTEGER NOT NULL,
    `player` VARCHAR(191) NOT NULL,
    `linkSporify` VARCHAR(191) NOT NULL,
    `AvailableBr` BOOLEAN NOT NULL,

    UNIQUE INDEX `Track_isrc_key`(`isrc`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
