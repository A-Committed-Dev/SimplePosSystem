// Send POST request using Axios
axios
  .post("/backend.php", allPayments)
  .then((response) => {
    // Handle the response from the PHP script
    console.log("Success:", response.data);
  })
  .catch((error) => {
    // Handle any errors
    console.error("Error:", error);
  });
doSync = false;

axios
  .get("/getData.php")
  .then((response) => {
    // Assuming your PHP script returns JSON data with the structure matching the TypeScript interface
    const data = response.data;
    console.log(response);
    syncedJson = data;
  })
  .catch((error) => {
    // Handle any errors
    console.error("Error fetching data:", error);
  });

allPayments = [];
syncedJson = {
  items: {
    Wraps: 1,
    Pandekage: 2,
    "Pandekage Bål": 1,
    "Suppe Med Brød": 0,
    Sodavand: 0,
    Vand: 0,
  },
  money: {
    totalEarned: 0,
    totalChangeGiven: 0,
    totalChangeBack: 0,
  },
};
console.log("this is json from db ->", syncedJson);

alert("Synced with database");
