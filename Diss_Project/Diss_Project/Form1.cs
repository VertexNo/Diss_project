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
            try
            {
                ConnectWithDB().GetAwaiter();
            }
            catch (Exception exp)
            {
                MessageBox.Show("Нет подключения к базе данных!");
            }
            
        }
        private static async Task ConnectWithDB()
        {
            //string connectionString = @"Data Source=.\SQLEXPRESS;Initial Catalog=DissBD;Integrated Security=True";
            string connectionString = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;

            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                await connection.OpenAsync();
                Console.WriteLine("Подключение открыто");
                System.Diagnostics.Debug.WriteLine("Подключение открыто");
            }
            System.Diagnostics.Debug.WriteLine("Подключение закрыто");
            Console.WriteLine("Подключение закрыто...");
        }
    }
}
