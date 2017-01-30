export const getFilteredDataBetween = (data = [], startDate = ``, endDate = ``) => {
  const filteredData = [];

  if (startDate !== ``) {
    const beginingDate = new Date(startDate);
    data.forEach(d => {
      const dataDate = new Date(d.date);
      if (dataDate.getTime() >= beginingDate.getTime()) {
        filteredData.push(d);
      }
    });
    data = filteredData;
  }

  if (endDate !== ``) {
    const endingDate = new Date(endDate);
    data.forEach(d => {
      const dataDate = new Date(d.date);
      if (dataDate.getTime() <= endingDate.getTime()) {
        filteredData.push(d);
      }
    });
    data = filteredData;
  }

  return data;
};
