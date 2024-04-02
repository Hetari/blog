import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime);

const formatPublishedDate = (date) => {
    return dayjs(date).fromNow();
};

const formatLikes = (likes) => {
    if (likes >= 1e6) {
        return (likes / 1e6).toFixed(1) + "M"; // Millions
    } else if (likes >= 1e3) {
        return (likes / 1e3).toFixed(1) + "K"; // Thousands
    } else if (likes >= 100) {
        return (likes / 100).toFixed(0) + "H"; // Hundreds
    } else {
        return likes.toString();
    }
};

export { formatPublishedDate, formatLikes };
