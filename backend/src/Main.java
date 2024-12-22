import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;

public class Main {
    private static String username;

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (true) {
            System.out.println("Welcome to the Money Transfer Application");
            System.out.println("1. Register");
            System.out.println("2. Login");
            System.out.println("3. Add Transaction");
            System.out.println("4. View Transactions");
            System.out.println("5. Exit");
            System.out.print("Enter your choice: ");
            int choice = scanner.nextInt();
            scanner.nextLine(); // Consume the newline

            switch (choice) {
                case 1:
                    register(scanner);
                    break;
                case 2:
                    login(scanner);
                    break;
                case 3:
                    addTransaction(scanner);
                    break;
                case 4:
                    viewTransactions();
                    break;
                case 5:
                    System.out.println("Exiting the application. Goodbye!");
                    scanner.close();
                    System.exit(0);
                default:
                    System.out.println("Invalid choice. Please try again.");
            }
        }
    }

    private static void register(Scanner scanner) {
        try {
            System.out.print("Enter your name: ");
            String name = scanner.nextLine();
            System.out.print("Enter your desired username: ");
            String desiredUsername = scanner.nextLine();
            System.out.print("Enter your password: ");
            String password = scanner.nextLine();

            String urlString = "http://localhost/php/register.php";
            String data = "name=" + name + "&username=" + desiredUsername + "&password=" + password;

            HttpURLConnection connection = sendPostRequest(urlString, data);
            int responseCode = connection.getResponseCode();

            if (responseCode == 200) {
                Scanner sc = new Scanner(connection.getInputStream());
                while (sc.hasNextLine()) {
                    System.out.println(sc.nextLine());
                }
                sc.close();
            } else {
                System.out.println("Registration failed.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void login(Scanner scanner) {
        try {
            System.out.print("Enter your username: ");
            String inputUsername = scanner.nextLine();
            System.out.print("Enter your password: ");
            String password = scanner.nextLine();

            String urlString = "http://localhost/php/login.php";
            String data = "username=" + inputUsername + "&password=" + password;

            HttpURLConnection connection = sendPostRequest(urlString, data);
            int responseCode = connection.getResponseCode();

            if (responseCode == 200) {
                Scanner sc = new Scanner(connection.getInputStream());
                String response = "";
                while (sc.hasNextLine()) {
                    response += sc.nextLine();
                }
                sc.close();
                if (response.contains("Login successful")) {
                    username = inputUsername;
                    System.out.println("Login successful!");
                } else {
                    System.out.println(response);
                }
            } else {
                System.out.println("Login failed.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void addTransaction(Scanner scanner) {
        if (username == null) {
            System.out.println("You need to login first.");
            return;
        }

        try {
            System.out.print("Enter the first currency: ");
            String firstCurrency = scanner.nextLine();
            System.out.print("Enter the second currency: ");
            String secondCurrency = scanner.nextLine();
            System.out.print("Enter the exchange rate: ");
            double exchangeRate = scanner.nextDouble();
            System.out.print("Enter the amount to convert: ");
            double amount = scanner.nextDouble();
            scanner.nextLine(); // Consume the newline

            String urlString = "http://localhost/php/transfer.php";
            String data = "username=" + username + "&first_currency=" + firstCurrency + "&second_currency=" + secondCurrency +
                          "&exchange_rate=" + exchangeRate + "&amount=" + amount;

            HttpURLConnection connection = sendPostRequest(urlString, data);
            int responseCode = connection.getResponseCode();

            if (responseCode == 200) {
                Scanner sc = new Scanner(connection.getInputStream());
                while (sc.hasNextLine()) {
                    System.out.println(sc.nextLine());
                }
                sc.close();
            } else {
                System.out.println("Failed to add transaction.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void viewTransactions() {
        if (username == null) {
            System.out.println("You need to login first.");
            return;
        }

        try {
            String urlString = "http://localhost/php/view_transactions.php";
            String data = "username=" + username;

            HttpURLConnection connection = sendPostRequest(urlString, data);
            int responseCode = connection.getResponseCode();

            if (responseCode == 200) {
                Scanner sc = new Scanner(connection.getInputStream());
                while (sc.hasNextLine()) {
                    System.out.println(sc.nextLine());
                }
                sc.close();
            } else {
                System.out.println("Failed to fetch previous transactions.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static HttpURLConnection sendPostRequest(String urlString, String data) throws Exception {
        URL url = new URL(urlString);
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();
        connection.setRequestMethod("POST");
        connection.setDoOutput(true);
        connection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");

        OutputStream os = connection.getOutputStream();
        os.write(data.getBytes());
        os.flush();
        os.close();

        return connection;
    }
}
