using System;
using System.Configuration;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace Diss_Project
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            string connectionString = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;
            bool Connect = false;
            try
            {
                ConnectWithDB().GetAwaiter(); //Проверка асинхронно подключения к БД
                Connect = true; //Установили что подключение есть
                
            }
            catch (Exception exp)
            {
                MessageBox.Show("Нет подключения к базе данных!"); //Лог
            }
            if (Connect) //Если есть подключение
            {
                using (SqlConnection connection = new SqlConnection(connectionString)) //Подключаемся к базе
                {                    
                    connection.Open();
                    SqlCommand command = new SqlCommand(); //новая СКЛ команда
                    command.CommandText = "SELECT * FROM Users where login ='"+textBox1.Text+"' and password ='"+textBox2.Text+"';";
                    command.Connection = connection;
                    SqlDataReader dr = command.ExecuteReader(); //Ридер для получения данных из селекта
                    
                    if (dr.HasRows) //если ридер нашел и вернул данные
                    {
                        Console.WriteLine("Авторизация пройдена");
                    }
                    else
                    {
                        MessageBox.Show("Не удалось авторизоваться с введенными данными!");
                    }
                }
            }
            
        }
        private static async Task ConnectWithDB()
        {
            //string connectionString = @"Data Source=.\SQLEXPRESS;Initial Catalog=DissBD;Integrated Security=True";
            string connectionString = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString; //брется из файла App.Config строка подключения к БД

            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                await connection.OpenAsync();
                Console.WriteLine("Подключение открыто");
            }
            Console.WriteLine("Подключение закрыто...");

        }
    }
}
